function contadorCaracteres(obj){
    var maxLength = 520;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);
    //console.log(obj);
    if(charRemain < 0){
        document.getElementById("numeroCaracteres").innerHTML = '<span style="color: red;">El limite de caracteres es de '+maxLength+' </span>';
    }else{
        document.getElementById("numeroCaracteres").innerHTML = charRemain+' caracteres restantes';
    }
}