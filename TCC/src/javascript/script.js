document.getElementById('open_btn').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('open-sidebar');
});


const data = [
    {
        image: "./src/imagens/imagemModulo1.png",
        title: "O que é Libras e como foi criada",
        description: "20 lições 40h",
        button: "<span class='material-symbols-outlined'>bookmark </span>"
        
    },
    {
        image: "./src/imagens/imagemModulo2.png",
        title: "Primeiros contatos com as libras",
        description: "20 lições 40h",
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
                <h3>${e.title}</h3>
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