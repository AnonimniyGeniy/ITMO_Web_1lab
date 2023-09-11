let x, y, r = [];

function getMarkedBoxes(){
    let allCheckBoxes = document.querySelectorAll('input[type="checkbox"]');
    let markedBoxes = [];
    for(let i  = 0; i < allCheckBoxes.length; i++){
        if(allCheckBoxes[i].checked){
            markedBoxes.push(allCheckBoxes[i]);
        }
    }
    return markedBoxes;
}

function validateAndSubmit(){

}

function validateX(){
    let data = document.getElementById('x').value;
    if(data == ""){
        alert("No value in select chosen.");
        return false;
    }
    return true;
}

function validateY(){
    let rawY = document.getElementById('y').value;
    let ymin = -5;
    let ymax = 5;
    try{
        let value_y = parseFloat(rawY);
        if (value_y > ymin && value_y < ymax){
            y = value_y;
            return true;
        }else{
            alert("Y - значение в интервале (-5, 5).")
            return false;
        }
    }catch (error){
        alert("Y - значение в интервале (-5, 5).")
        return false;
    }
}

function validateR(){
    let markedBoxes = getMarkedBoxes();
    if(markedBoxes.length >= 1){
        for(let i = 0; i < markedBoxes.length; i++){
            switch (markedBoxes[i].name){
                case "r_1":
                    r.push(1);
                    break;
                case "r_15":
                    r.push(1.5);
                    break;
                case "r_2":
                    r.push(2);
                    break;
                case "r_25":
                    r.push(2.5);
                    break;
                case "r_3":
                    r.push(3);
                    break;
            }
        }
        return true;
    }else{
        alert("Не выбрано ни одного значения R.");
        return false;
    }
}

function validate(){
    return validateX() && validateY() && validateR();
}