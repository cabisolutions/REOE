var costo = document.getElementById('costo');

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

document.getElementById('inicio_renta').value = new Date().toDateInputValue();

var inicioRenta = document.getElementById('inicio_renta')
var inicioValor = new Date(inicioRenta.value)
function inicioFecha(){
    inicioValor = inicioRenta.value
    cacularCosto()

}
var finRenta = document.getElementById('fin_renta')
var finValor

function finFecha(){
    finValor = new Date(finRenta.value)
    console.log(finValor)
    cacularCosto()
}
var costoDia = document.getElementById('costo').value
function cacularCosto() {
    var costoRenta = (finValor - inicioValor)/(1000 * 3600 * 24)
    document.getElementById('costo').value = costoDia * costoRenta
    console.log(costoRenta)
}