document.getElementById('open_btn').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('open-sidebar');
});


const data = [
    {
        image: "./src/imagens/imagemModulo1.png",
        title: "Alfabeto, Números e gestos diários",
        description: "4 lições 30min",
        button: "<span class='material-symbols-outlined'>bookmark </span>"
        
    }
];

const cardContainer = document.querySelector(".container");
const barraPesquisa = document.querySelector("#barraDePesquisa");

const displayData = data => {
    cardContainer.innerHTML = "";
    data.forEach(e => {
        cardContainer.innerHTML += `
    <div class = "card">
        <div class = "card-main">
            <img src="${e.image}">
            <div class = "main-infos-um">
                <a href="Mod.acessado.php"><h3>${e.title}</h3></a>
            </div>
            <div class = "main-infos-dois">
                <p>${e.description}</p>
                <button>${e.button}</button>
            </div>
        </div>
    </div>  
        `
    })
} 

barraPesquisa.addEventListener("keyup",(e)=>{
    const pesquisa = data.filter(i => i.title.toLocaleLowerCase().includes(e.target.value.toLocaleLowerCase()))
    displayData(pesquisa);
})

window.addEventListener("load", displayData.bind(null,data))
