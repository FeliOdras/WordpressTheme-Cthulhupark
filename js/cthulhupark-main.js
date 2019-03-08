responsiveMenu = () => {
    const menuContainer = document.querySelector("#navigation-container");
    menuContainer.classList.toggle("visible");
}

getLatestsDairies = () => {
    fetch('https://hq.cthulhupark.de/wp-json/wp/v2/posts/?categories=2&&per_page=50&&orderby=modified')
    .then(response => response.json())
    .then (dairyEntries =>{ 
        console.log(dairyEntries)
        dairyEntries.forEach(posts => {
            console.log(`Title ${posts.title.rendered}. Last modified ${posts.modified}`)
        });
    })
    .catch (error => console.log('something went wrong'))
}
(getLatestsDairies())