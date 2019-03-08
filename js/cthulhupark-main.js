responsiveMenu = () => {
    const menuContainer = document.querySelector("#navigation-container");
    menuContainer.classList.toggle("visible");
}

class LatestDairies {
    constructor(domselector) {
        this.apiUrl='https://hq.cthulhupark.de/wp-json/wp/v2/posts/?categories=2&&per_page=50&&orderby=modified';
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
        let latestEntries = entryList.filter(entry => entry.diffDays < 21);
        console.log(latestEntries)
        return latestEntries;
    }

    template(){
        let entryList = this.showLatest();
        return entryList
        .map (entry => {
            return`
                <a href="${entry.link}" title="${entry.title.rendered}">
                    ${entry.title.rendered}</a><br>
                <small>(vor ${entry.diffDays} ${entry.diffDays == 1 ? 'Tag' : 'Tagen'})</small><br>
            `
        }).join('')
    }

    render(){
        let output = this.template();
        this.htmlContainer.innerHTML = output;
    }

}
const latestTBE = new LatestDairies('.latestTBE')