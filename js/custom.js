let btnAdd = document.querySelector('.btn-tambah');
let btnMin = document.querySelector('.btn-kurang');
let inp = document.querySelector('.inp');

btnAdd.addEventListener('click',()=>{
    inp.value = parseInt(inp.value) + 1;
})

btnMin.addEventListener('click',()=>{
    inp.value = parseInt(inp.value) - 1;
})