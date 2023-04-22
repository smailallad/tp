const modalContainer = document.querySelector(".modal-container")
const modalTriggers = document.querySelectorAll(".modal-trigger");

modalTriggers.forEach(trigger => trigger.addEventListener("click",toggleModal))

function toggleModal(event){
    console.log(event.target)
    const modal = event.target.dataset.modal
    console.log(modal)
    if (modal != undefined){
        //document.getElementById(modal).classList.toggle("active")
    }
    modalContainer.classList.toggle("active")
}