$( document ).ready(function() {
    const findAllHolidays = async (country) => {
        const request = "/cvicenia/cvicenie6/service/holidays/findAll.php?country="+country;
        const response = await fetch(request);
        const myJson = await response.json();
        if(myJson["holidays"]){
            loadDataToTable(myJson["holidays"]);
        }else{
            resultClick.html(myJson["message"]);
            errorMessage();
        }
    }
    const findAllMemorableDays = async (country) => {
        const request = "/cvicenia/cvicenie6/service/memorable_days/findAll.php?country="+country;
        const response = await fetch(request);
        const myJson = await response.json();
        if(myJson["memorable_days"]){
            loadDataToTable(myJson["memorable_days"]);
        }
        else{
            resultClick.html(myJson["message"]);
            errorMessage();
        }
    }
    const findNameByDateAndCountry = async (day,month,country) => {
        const request = "/cvicenia/cvicenie6/service/names/findByDateAndCountry.php?country="+country+"&day="+day+"&month="+month;
        const response = await fetch(request);
        const myJson = await response.json();
        if(myJson["names"]){
            loadToSecondResult(myJson["names"]);}
        else{
            resultClick.html(myJson["message"]);
            errorMessage();
        }

    }
    const findByName = async (name,country) => {
        const request = "/cvicenia/cvicenie6/service/names/findByName.php?country="+country+"&name="+name;
        const response = await fetch(request);
        const myJson = await response.json();
        if(myJson["names"]){
            loadToSecondResult(myJson["names"]);}
        else{
            resultClick.html(myJson["message"]);
            errorMessage();
        }
    }
    const insertName = async (name,day,month,country) => {
        const request = "/cvicenia/cvicenie6/service/names/insertNew.php";
        let formData = {name:name,day:day,month:month,country:country};
        let response = await fetch(request, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(formData)
        });
        let result = await response.json();
        if(result["message"] == "Name was created."){
            new jBox('Notice', {
                animation: 'flip',
                color: 'green',
                content: 'Meno bolo úspešne pridané.',
                delayOnHover: true,
                showCountdown: true
            });
        }else{
            new jBox('Notice', {
                animation: 'flip',
                color: 'red',
                content: 'Nastala chyba !',
                delayOnHover: true,
                showCountdown: true
            });
        }

        resultClick.html(result["message"]);
    }
    let controller = $("#inputGroupSelect02");
    let result = $("#result");
    let resultClick = $("#resultTwo");
    controller.change(function (){
        resultClick.html('');
        result.html('');
        let userAction = controller.val();
        if(userAction === "whoHasName"){
            result.html(loadInputDateForm()+loadSelectForm()+loadButton());
            let button = $("#button");
            button.click(function (){
                let date = new Date($('#date').val());
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let country = $("#countries").val();
                findNameByDateAndCountry(day,month,country);

            });
        }
        else if(userAction === "whenHasName"){
            result.html(loadSelectForm()+loadInput()+loadButton());
            let button = $("#button");
            button.click(function (){
                let name = $("#name").val();
                let country = $("#countries").val();
                findByName(name,country);
            });
        }
        else if(userAction === "holidaysSK"){
            findAllHolidays("SK");
        }
        else if(userAction === "holidaysCZ"){
            findAllHolidays("CZ");
        }
        else if(userAction === "memorableDaysSK"){
            findAllMemorableDays("SK");
        }
        else if(userAction === "insertNewNameSKd"){
            result.html(loadInputDateForm()+loadSelectForm()+loadInput()+loadButton());
            let button = $("#button");
            button.click(function (){
                let date = new Date($('#date').val());
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let name = $("#name").val();
                let country = $("#countries").val();
                insertName(name,day,month,country);
            });
        }

    });

       // findAllHolidays("SK");
       // findAllHolidays("CZ");
       // findAllMemorableDays("SK");
       // findNameByDateAndCountry("1","2","SK");
       // findByName("Peter","SK");
       // insertName("Judáš",365,12);

    function createTable(){
        return '<div class="input-group mb-3">\n' +
            '    <div class="mx-auto">\n' +
            '        <div class="input-group input-group-lg ">\n' +
            '         <table  id="table" >\n' +
            '                        <thead>\n' +
            '                        <tr>\n' +
            '                            <th>Dátum</th>\n' +
            '                            <th>Názov</th>\n' +
            '                        </tr>\n' +
            '                        </thead>\n' +
            '                            <tbody></tbody>\n' +
            '                    </table>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>'
    }
    function loadDataToTable(data){
        result.html(createTable());
        let table = $("#table").DataTable({
            "searching": false,
            "ordering": false,
            "paging":   false,
            "info":     false,
        });
        table.clear().draw();
        $.each(data, function(i, row){
            table.row.add([
                row["date"],
                row["name"]
            ]).draw(false);
        });
    }
    function loadInputDateForm(){
        return '<div class="input-group mb-3">\n' +
        ' <div class="input-group input-group-lg">'+
            '  <span class="input-group-text" id="addon-wrapping">Dátum</span>\n' +
            '  <input  id="date" type="date" class="form-control" placeholder="Dátum" aria-label="Dátum" aria-describedby="addon-wrapping" required>\n' +
        '</div> \n'+
        '</div> \n'
    }
    function  loadSelectForm(){
        return      '<div class="input-group mb-3">\n' +
                     '<div class="input-group input-group-lg">'+
                '  <label class="input-group-text" for="inputGroupSelect01">Krajiny</label>\n' +
                '  <select  id="countries" class="form-select" id="inputGroupSelect01" required>\n' +
                '    <option selected>Vyber krajinu...</option>\n' +
                '    <option value="SK">Slovensko</option>\n' +
                '    <option value="CZ">Česko</option>\n' +
                '    <option value="AT">Rakúsko</option>\n' +
                '    <option value="HU">Maďarsko</option>\n' +
                '    <option value="PL">Poľsko</option>\n' +
                '    <option value="SKd">Sk dni</option>\n' +
                '  </select>\n' +
                '</div>' +
            '</div>'

    }
    function loadInput(){
        return '<div class="input-group mb-3">\n' +
            ' <div class="input-group input-group-lg">'+
            '  <span class="input-group-text" id="addon-wrapping">Meno</span>\n' +
            '  <input  id="name" type="input" class="form-control" placeholder="Meno" aria-label="Dátum" aria-describedby="addon-wrapping" required>\n' +
            '</div> \n'+
            '</div> \n'
    }
    function loadButton(){
        return      '    <div class="mx-auto">\n' +
            '<button id="button" type="submit" class="btn btn-primary">Potvrdiť</button>'+
            '</div>';
    }
    function loadToSecondResult(data){
        resultClick.html(data[0]["date"]+' má meniny : ');
        $.each(data,function (i, name){

            resultClick.append(name["name"]);
            if(i < data.length-1){
                console.log(data.length)
                resultClick.append(', ');
            }
        })
    }
    function errorMessage(){
        new jBox('Notice', {
            animation: 'flip',
            color: 'red',
            content: 'Nastala chyba !',
            delayOnHover: true,
            showCountdown: true
        });
    }
});