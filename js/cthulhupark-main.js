responsiveMenu = () => {
    const menuContainer = document.querySelector("#navigation-container");
    menuContainer.classList.toggle("visible");
}

class LatestDairies {
    constructor(domselector) {
        this.apiUrl='https://hq.cthulhupark.de/wp-json/wp/v2/posts/?categories=2&&per_page=50&&orderby=modified';
        this.htmlContainer = document.querySelector(domselector);
        this.fetchData()
    }

    fetchData() {
        fetch(this.apiUrl)
        .then (response => response.json())
        .then (tbeEntries => {
            this.tbeEntries = tbeEntries;
            this.render();
        })
    }

    template(){
        let entryList = this.tbeEntries;
        console.log(entryList);
        return entryList;
    }

    render(){
        console.log(this.tbeEntries)
        let template = this.template()
        let output = ``;
        output += template;
        this.htmlContainer.innerHTML = output;
    }

}
const latestTBE = new LatestDairies('.latestTBE')

// getLatestsDairies = () => {
//     fetch('https://hq.cthulhupark.de/wp-json/wp/v2/posts/?categories=2&&per_page=50&&orderby=modified')
//     .then(response => response.json())
//     .then (dairyEntries =>{ 
//         console.log(dairyEntries)
//         dairyEntries.forEach(posts => {
//             console.log(`Title ${posts.title.rendered}. Last modified ${posts.modified}`)
//         });
//     })
//     .catch (error => console.log('something went wrong'))
// }
//(getLatestsDairies())