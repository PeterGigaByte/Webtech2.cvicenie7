$( document ).ready(function() {
    if($.cookie('cookies')!="true"){
        new jBox('Confirm', {
            confirmButton: 'Súhlasím',
            cancelButton: 'Nesúhlasím',
            content: "Naša stránka si ukláda vaše údaje gps,mesta a ip adresy do databázy, ak s tým súhlasíte stlačte potvrdiť. V prípade, že nie, budete presmerovaný na stránku 'https://www.google.com/'",
            confirm: function () {
                $.cookie("cookies", true);
            },
            cancel: function (){
                $.cookie("cookies", false);
                $.ajax({
                    type : "GET",
                    url : "https://wt130.fei.stuba.sk/cvicenia/cvicenie7/api/delete.php",
                    async: false,
                    contentType : "application/json",
                    success: function(result){
                        self.location = 'https://www.google.com/'
                    },
                    error : function(e) {
                        new jBox('Notice', {
                            animation: 'flip',
                            color: 'red',
                            content: 'Niečo zlyhalo!',
                            delayOnHover: true,
                            showCountdown: true
                        });
                        console.log(e)
                    }
                });
            }
        }).open();
    }
});