let menuitems = document.querySelectorAll('.items > li');
menuitems.forEach(items=> {
    let submenu = items.querySelector('.submenu')||
    items.querySelector('.submenu0')||
    items.querySelector('.submenu2')||
    items.querySelector('.submenu3');
    if (submenu) {
        items.addEventListener('mouseenter',()=>{
            submenu.style.display ='block';
        });
        
        items.addEventListener('mouseleave',()=>{
            submenu.style.display ='none';
        });
    }
});
let search = document.querySelector('.bx-search-alt-2');
let clique = document.querySelector('.subclick');
search.addEventListener('click',()=>{
   if (clique.style.display==='block') {
    clique.style.display==='none';
   }else{
    clique.style.display==='block';
    clique.style.display==='margin-left: -206px;';
   }
});



