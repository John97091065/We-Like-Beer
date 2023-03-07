const nums = document.querySelectorAll('.num')
const form = document.querySelector('form')
document.addEventListener('paste', handlePaste);

function handlePaste(evt)
{
    if(evt.target.localName != 'input') return;
    evt.preventDefault();

    //pakt de data van clipboard en laat het kopieeren 
    let paste = (evt.clipboardData || window.clipboardData).getData('text');
    paste = paste.toUpperCase()
    //console.log(paste); 
    let inputs = document.querySelectorAll('.num')
    if(paste.length != inputs.length) ;
    inputs.forEach((input, index)=>
    {
        input.value = paste[index];
    })
}

//zet focus naar volgende textbox
nums.forEach((num, index) => {

    //voegt een data-id toe aan de nummer input
    num.dataset.id = index 

    //select de volgende textbox
    num.addEventListener('keydown', (e) => {
        if(e.keyCode == 39, num.value.length == 1)
        {
            if(num.dataset.id == [5])
            {
                num.blur()
            }
            else
            {
                nums[parseInt(num.dataset.id) + 1].focus()
            }
        }
    })
})

//houdt de focus op de textbox
nums.forEach((num, index) => {
    num.addEventListener('keydown', (e) => {
        if(e.keyCode == 8)
        {
            nums[parseInt(num.dataset.id) - 0].focus()
        }
    })
})

//zet focus naar vorige textbox
nums.forEach((num, index) => {
    num.addEventListener('keydown', (e) => {
        if(e.keyCode == 37)
        {
            if(num.dataset.id == [0])
            {
                num.blur()
            }
            else
            {
                nums[parseInt(num.dataset.id) - 1].focus()
            }
        }
    })
})

function isInputNumber(evt) {
    //checkt of de input een nummer is
    var ch = String.fromCharCode(evt.which);
    if(!(/[0-9]/.test(ch))){
        evt.preventDefault();
    }
}

function btnSend()
{
    //zet alle inputs in een variabele
    let inputs = document.querySelectorAll('.num')
    let code = '';
    inputs.forEach((input)=>
    {
        code += input.value;
    })
    console.log(code);
}
