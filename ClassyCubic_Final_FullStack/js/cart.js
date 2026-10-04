document.querySelectorAll('.qty-box').forEach(input=>input.addEventListener('change',()=>{if(Number(input.value)<0)input.value=0;}));
