const modalTriggers = document.querySelectorAll(".modal-trigger");
modalTriggers.forEach(trigger => trigger.addEventListener("click",toggleModal))

function toggleModal(event){
    console.log(event.target)
    const modal = event.currentTarget.dataset.modal
//    const element = event.target.tagName
//    const modalContainer = document.querySelector(".modal-container")
    const modalContainer = document.querySelector(".modal-container[data-modal='" + modal + "']")
//    console.log(modal)
//    console.log(event.target.tagName)
//    console.log(modalContainer)
    modalContainer.classList.toggle("active")
}