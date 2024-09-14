function cpf(v){
    v=v.replace(/\D/g,"")                    
    v=v.replace(/(\d{3})(\d)/,"$1.$2")      
    v=v.replace(/(\d{3})(\d)/,"$1.$2")                                 
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") 
    return v
}

function formatarcpf(input){
    input.value = cpf(input.value); //Atualiza o valor do campo com o formato CPF
}

window.onload = function () {
    let botao = document.getElementById("botao1");
    let cep = document.querySelector("#cep");
    console.log(cep.value);
    let rua = document.querySelector("#rua");
    let numero = document.querySelector("#numero");
    let bairro = document.querySelector("#bairro");
    let cidade = document.querySelector("#cidade");
    let estado = document.querySelector("#estado");
    let complemento = document.querySelector("#complemento");

    botao.addEventListener("click", () => {

        let servidor = "https://viacep.com.br/ws/" + cep.value + "/json/";

        fetch(servidor).then((resp) => {return resp.json();}
    ).then (
        (data) => {
            rua.value = data["logradouro"];
            if (rua.value == "") {
                rua.value = "Vazio";
            }
            numero.value = data["unidade"];
            if (numero.value == "") {
                numero.value = "Vazio";
            }
            bairro.value = data["bairro"];
            if (bairro.value == "") {
                bairro.value = "Vazio";
            }
            cidade.value = data["localidade"];
            if (cidade.value == "") {
                cidade.value = "Vazio";
            }
            estado.value = data["uf"];
            if (estado.value == "") {
                estado.value = "Vazio";
            }
            complemento.value = data["complemento"];
            if (complemento.value == "") {
                complemento.value = "Vazio";
            }
        }
    ).catch(
        (er) => console.error(er)
    )


    })

    const inputrg = document.getElementById('rg');
    inputrg.addEventListener('input', function(e) {
       let rg = e.target.value;
   
       rg = rg.replace(/\D/g, '');
   
       rg = rg.replace(/^(\d{2})(\d)/, '$1.$2'); 
       rg = rg.replace(/(\d{3})(\d)/, '$1.$2');
       rg = rg.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); 
   
       e.target.value = rg;
   });

}

const mascaraTel = (event) => {
    let input = event.target
    input.value = phoneMask(input.value)
  }
  
  const phoneMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g,'')
    value = value.replace(/(\d{2})(\d)/,"($1) $2")
    value = value.replace(/(\d)(\d{4})$/,"$1-$2")
    return value
  }

  const mascaraCEP = (event) => {
     let input = event.target
  input.value = zipCodeMask(input.value)
}

const zipCodeMask = (value) => {
  if (!value) return ""
  value = value.replace(/\D/g,'')
  value = value.replace(/(\d{5})(\d)/,'$1-$2')
  return value
}




 const inputrg = document.getElementById('rg');
 inputrg.addEventListener('input', function(e) {
    let rg = e.target.value;

    rg = rg.replace(/\D/g, '');

    rg = rg.replace(/^(\d{2})(\d)/, '$1.$2'); 
    rg = rg.replace(/(\d{3})(\d)/, '$1.$2');
    rg = rg.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); 

    e.target.value = rg;
});
  

