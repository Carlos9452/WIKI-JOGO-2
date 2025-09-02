// função para confirmar a exclusão de dados
function confirma_exclusao(cod){
    var resp = confirm('confirmar a exclusão do registro');
    
    if (resp == true){
        window.open('participante-exclui.php?cod=' + cod, '_self');
    }else{
        alert('nenhum registro foi excluido.');
    }
}

// função para confirmar a exclusão de dados
function confirma_alteracao(){
    var resp = confirm('confirmar a exclusão do registro');
    
    if (resp == true){
       document.getElementById('form_edita').submit();
    
    }else{
        alert('nenhum dado modificado.\nVoltando para a lista de participantes.');
        window.open('participante-lista.php', '_self');
    }
}