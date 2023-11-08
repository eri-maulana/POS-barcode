function progres(){
   let progress = document.querySelector('.progress');
   let step = 10;
   let loading = setInterval(move, 50);

   function move(){
      if (step == 400) {
         clearInterval(loading);
         document.location = "auth/login.php";
      } else {
         step += 10;
         progress.style.width = step + "px";
      }
   }

}
progres();

