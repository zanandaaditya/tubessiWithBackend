var li_items = document.querySelectorAll(".side-bar ul li");
var hamburger = document.querySelector(".hamburger");
var wrapper = document.querySelector(".wrapper");

li_items.forEach((li_item)=>{
    li_item.addEventListener("mouseenter",()=>{
        if(wrapper.classList.contains("click-collapse"))
        {
            return;
        }
        else
        {
            li_item.closest(".wrapper").classList.remove("hover-collapse");
        }
    })
})

li_items.forEach((li_item)=>{
    li_item.addEventListener("mouseleave",()=>{
        if(wrapper.classList.contains("click-collapse"))
        {
            return;
        }
        else
        {
            li_item.closest(".wrapper").classList.add("hover-collapse");
        }
    })
})

hamburger.addEventListener("click",()=>{
    hamburger.closest(".wrapper").classList.toggle("click-collapse");
    hamburger.closest(".wrapper").classList.toggle("hover-collapse");
})


