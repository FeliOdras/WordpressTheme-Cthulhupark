responsiveMenu = () => {
    const menuContainer = document.querySelector("#navigation-container");
    menuContainer.classList.toggle("visible");
}

getWPApi = () => {
    fetch('https://hq.cthulhupark.de/wp-json/wp/v2/posts/?categories=2&&per_page=50&&orderby=modified')
    .then(response => response.json())
    .then (data =>{ 
        console.log(data)
        data.forEach(posts => {
            console.log(`Title ${posts.title.rendered}. Last modified ${posts.modified}`)
        });
    })
    .catch (error => console.log('something went wrong'))
}
(getWPApi())