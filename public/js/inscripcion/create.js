const init = () =>{
    document.querySelector('#select_periodo').addEventListener('change',capture,true);
}
const capture = (e) =>{
    const index_select_periodo = e.target.selectedIndex
    console.log(index_select_periodo);

    $.get('../../api/inscripcion/27758801/'+index_select_periodo, function(data){
        console.log(data)
    });
}

init();