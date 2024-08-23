function sortInvBy(value){
                
    var searchParams = new URLSearchParams(window.location.search);
    
    
    if(searchParams.has('sortInvoicesBy')) {
        
        if(searchParams.has('invoicesOrder')){
            if(searchParams.get('sortInvoicesBy') == value){
                
                if(searchParams.get('invoicesOrder') == 'ASC'){
                    searchParams.set('invoicesOrder', 'DESC');
                } else {
                    searchParams.set('invoicesOrder', 'ASC');
                }
            }
            else searchParams.set('invoicesOrder', 'ASC');
        } else {
            searchParams.append('invoicesOrder', 'ASC');
        }
        
        searchParams.set('sortInvoicesBy', value);
    } else {
        searchParams.append('sortInvoicesBy', value);
        searchParams.append('invoicesOrder', 'ASC');
    }
    
    window.location.search = searchParams;
}

function sortPayBy(value){
    
    var searchParams = new URLSearchParams(window.location.search);
    
    
    if(searchParams.has('sortP')) {
        
        if(searchParams.has('pOrder')){
            if(searchParams.get('sortP') == value){
                if(searchParams.get('pOrder') == 'ASC'){
                    searchParams.set('pOrder', 'DESC');
                } else {
                    searchParams.set('pOrder', 'ASC');
                }
            }
            else searchParams.set('pOrder', 'ASC');
        } else {
            searchParams.append('pOrder', 'ASC');
        }
        
        searchParams.set('sortP', value);
    } else {
        searchParams.append('sortP', value);
        searchParams.append('pOrder', 'ASC');
    }
    
    window.location.search = searchParams;
}

function setSearchParam(searchParams, paramName, paramValue){

    if(paramValue){
        if(searchParams.has(paramName)) {
            searchParams.set(paramName, paramValue);
        } else {
            searchParams.append(paramName, paramValue);
        }
    } else {
        searchParams.delete(paramName);
    }
   
    return searchParams;
}

function filterInvoices(){
    event.preventDefault();
    
    var searchParams = new URLSearchParams(window.location.search);
    
    var searchForm = document.querySelector("#invoices-search-form");
    
    var number = searchForm.querySelector("input[name='number']").value;
    var date = searchForm.querySelector("input[name='date']").value;
    var due_date = searchForm.querySelector("input[name='due_date']").value;
    var gross_total = searchForm.querySelector("input[name='gross_total']").value;
    
    searchParams = setSearchParam(searchParams, 'iNumber', number);
    searchParams = setSearchParam(searchParams, 'iDate', date);
    searchParams = setSearchParam(searchParams, 'iDueDate', due_date);
    searchParams = setSearchParam(searchParams, 'iGrossTotal', gross_total);
    
    window.location.search = searchParams;
}
