document.querySelector(".nav-logo").addEventListener("click", ()=>{
    if(    document.querySelector(".nav-panel").style.display=="block"){
        document.querySelector(".nav-panel").style.display="none"
    }else{
        document.querySelector(".nav-panel").style.display="block"
    }
})

if(document.querySelector(".profile_summery")){
    function showAccount(){
        if(document.querySelector(".profile_summery").classList.contains("active_profile_summery")){
            document.querySelector(".profile_summery").classList.remove("active_profile_summery")
        }else{
            document.querySelector(".profile_summery").classList.add("active_profile_summery")

        }
    }
}