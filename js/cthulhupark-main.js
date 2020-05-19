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
            let diffHours = Math.ceil(timeDiff / (1000 * 3600));
            entry.diffHours = diffHours;   
        });
        return tbeEntries;
    }

    showLatest(){
        let entryList = this.addDiffDays();
        let latestEntries = entryList.filter(entry => entry.diffHours < 192);
        return latestEntries;
    }

    template(){
        let entryList = this.showLatest();
        return entryList
        .map (entry => {
            return`
                <a href="${entry.link}" title="${entry.title.rendered}"><strong>
                    ${entry.title.rendered}</strong></a><br>
                <small>Zuletzt geändert: ${entry.diffHours <= 1 ? `gerade eben` : entry.diffHours  <= 24 ? `vor ${entry.diffHours} Stunden` : entry.diffHours  <= 48 ? `gestern` : `vor ${Math.floor(entry.diffHours / 24) } Tagen`}</small><br>
            `
        }).join('')
    }

    addEventListeners(trigger, target) {
        document.querySelector(trigger).onclick = event => {
            document.querySelector(target).classList.toggle("hidden");
            document.querySelector(trigger).classList.toggle("trigger-active")
        }
    }

    render(){
        let output = ``;
        let template = this.template();
        let entriesLatest = this.showLatest();
        let countLatest = entriesLatest.length;
        output += `<h3 class="widget-title" id="latestTBETitle">Letzte Aktualisierungen (${countLatest})</h3>`;
        output += `<div class="widget-container hidden" id="latestTBEEntries">`;
        output += template;
        output += `</div>`
        this.htmlContainer.innerHTML = output;
        this.addEventListeners("#latestTBETitle","#latestTBEEntries");
        this.addEventListeners(".widget_cptbe_widget .widget-title",".widget_cptbe_widget ul.tbe-ul");
        this.addEventListeners(".widget_sk .widget-title", ".widget_sk .sk-comment")
    }

}
const latestTBE = new LatestDairies('.latestTBE')

document.querySelectorAll('.sk-comment').classList.add('hidden');
document.querySelector('.widget_sk .widget-title').onclick = event => {
    document.querySelectorAll(".sk-comment").classList.toggle('hidden');
    document.querySelector('.widget_sk .widget-title').classList.toggle("trigger-active")
}

//document.querySelector(".widget_cptbe_widget .widget-title").onclick = event => {
//     document.querySelector(".widget_cptbe_widget ul").classList.toggle("hidden");
 //}

 //showHideWidget(trigger, target) {
 //    document.querySelector(trigger).onclick = event => {
 //        document.querySelector(target).classList.toggle('hidden')
 //    }
// }

// showHideWidget('.widget_cptbe_widget .widget-title', '.widget_cptbe_widget ul')