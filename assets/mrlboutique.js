let item1 = document.getElementById('item1');
let item2 = document.getElementById('item2');
let item3 = document.getElementById('item3');
let item4 = document.getElementById('item4');

if ( item1 ){
    item1.addEventListener('click', function(){
        window.location.href = script_params.myPrefixLink[0];
    })
}

if ( item2 ){
    item2.addEventListener('click', function(){
        window.location.href = script_params.myPrefixLink[1];
    })
}

if ( item3 ){
    item3.addEventListener('click', function(){
        window.location.href = script_params.myPrefixLink[2];
    })
}

if ( item4 ){
    item4.addEventListener('click', function(){
        window.location.href = script_params.myPrefixLink[3];
    })
}






