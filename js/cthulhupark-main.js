responsiveMenu = () => {
    const menuContainer = document.querySelector("#navigation-container");
    menuContainer.classList.toggle("visible");
}

class LatestDairies {
    constructor(domselector) {
        this.apiUrl='https://hq.cthulhupark.de/wp-json/wp/v2/posts/?categories=2&&per_page=20&&orderby=modified';
        this.htmlContainer = document.querySelector(domselector);
        this.entriesOutput = ``;
        this.fetchData();
    }

    fetchData() {
        fetch(this.apiUrl)
        .then (response => response.json())
        .then (tbeEntries => {
            this.tbeEntries = tbeEntries;
            this.render();
        })
    }

    addDiffDays() {
        let tbeEntries = this.tbeEntries;
        tbeEntries.forEach (entry => {
            let modDate = entry.modified;
            let nowDate = new Date();
            let timeDiff = Math.abs(Date.parse(modDate) - nowDate.getTime());
            let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            entry.diffDays = diffDays;      
        });
        return tbeEntries;
    }

    showLatest(){
        let entryList = this.addDiffDays();
        let latestEntries = entryList.filter(entry => entry.diffDays < 11);
        return latestEntries;
    }

    template(){
        let entryList = this.showLatest();
        return entryList
        .map (entry => {
            return`
                <a href="${entry.link}" title="${entry.title.rendered}"><strong>
                    ${entry.title.rendered}</strong></a><br>
                <small>(${entry.diffDays == 1 ? `heute` : entry.diffDays == 2 ? `vor ${entry.diffDays - 1 } Tag` : `vor ${entry.diffDays - 1 } Tagen`})</small><br>
            `
        }).join('')
    }

    render(){
        let output = ``;
        let template = this.template();
        let entriesLatest = this.showLatest();
        let countLatest = entriesLatest.length;
        output += `<h3 class="widget-title">Neueste Beiträge (${countLatest})</h3>`;
        output += `<div class="widget-container">`;
        output += template;
        output += `</div>`
        this.htmlContainer.innerHTML = output;
    }

}
const latestTBE = new LatestDairies('.latestTBE')