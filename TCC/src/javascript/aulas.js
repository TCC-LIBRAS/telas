const optionMenu = document.querySelector(".acesso-rapido"),
        botaoSlct = optionMenu.querySelector(".botaoSelect"),
        options = optionMenu.querySelectorAll(".opcoes"),
        btn_text = optionMenu.querySelector(".btn_text");

    selectbtn.addEventListener("click", () => optionMenu.classList.toggle("active"));

options.forEach(option => {
    option.addEventListener("click", ()=>{
        let selectedOption = option.querySelector(".btn_text").innerText;
        btn_text.innerText = selectedOption;
        console.log(selectedOption)
    })
    
})        