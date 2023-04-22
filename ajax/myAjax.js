/*<script>
        function charger(){
            let data = {a:23,b:'abcd',c:65}
            myAjax.myGet('contacts.json',data,success,error)
        }

        function upload(frm){
            myAjax.myPost('page1.php',frm,success,error)
        }

        function success(data){
            //data = JSON.parse(data)
            let valeur = ''
            for (i=0;i<data.length;i++){
                valeur += data[i].name + '<br>'
            }
            document.getElementById('p1').innerHTML = data
            console.log(data)
        }

        function error(err,tErr){
            console.log(err,tErr)
        }
</script>*/
//==========================================
var myAjax = {}
myAjax.getQs = function (data){
    let qs = []
    for (k in data){
        qs.push(k + '=' + data[k])
    }
    return qs.join('&')
}

myAjax.myGet = function (url,data,success,error){
    let xhr = new XMLHttpRequest()
    url = url + '?' + this.getQs(data)
    xhr.open('get',url)
    xhr.onreadystatechange = function (evt){
        if (xhr.readyState == 4){
            if (xhr.status == 200){
                success(xhr.responseText)
            }
            else{
                error(xhr.status,xhr.statusText)
            }
        }
    }
    xhr.send()
}

myAjax.myPost = function (url,form,success,error){
    let xhr = new XMLHttpRequest()
    xhr.open('post',url)
    //xhr.setRequestHeader('content-type','application/x-www-form-urlencoded')
    xhr.onreadystatechange = function (evt){
        if (xhr.readyState == 4){
            if (xhr.status == 200){
                success(xhr.responseText)
            }
            else{
                error(xhr.status,xhr.statusText)
            }
        }
    }
    xhr.send(new FormData(form))
}