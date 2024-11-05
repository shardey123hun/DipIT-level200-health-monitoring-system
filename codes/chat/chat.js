let send_btn= document.querySelector('#send')
let sender=document.querySelector('#user_id').value
let receiver=document.querySelector('#receiver').value

send_btn.addEventListener("click",()=>{
    let msg=document.querySelector('#message-input')
    let xhttp= new XMLHttpRequest()
    xhttp.open('POST', 'chat.php?sender='+sender+'&&receiver='+receiver+'&&msg='+msg.value+'&&att=',true)
    xhttp.send()
    xhttp.onreadystatechange=function (){
        console.log("sending....")
        if(this.readyState==4 && this.status==200){
            msg.value=""
            console.log(this.response)
        }
    }
})

setInterval(()=>{
    let msg=document.querySelector('#chat-window')
   let xhttp= new XMLHttpRequest()
   xhttp.open('GET', 'fetch_chat.php?receiver='+receiver,true)
   xhttp.send()
   xhttp.onreadystatechange=function (){
    if(this.readyState==4 && this.status==200){
        let msgold;
        if(msgold!==this.response){
        msg.innerHTML=" <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora consequuntur impedit unde, similique alias velit dolore aspernatur rem nostrum quasi suscipit inventore eum minima assumenda molestiae sit natus! Quae, dolore? </p>"+this.response+"<br id='now'>"
        msgold=this.response
        } 
    }
    window.scrollTop=window.scrollHeight
}
},500);