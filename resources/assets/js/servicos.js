async function fazLogin(email, password){

    let resposta = await executaPost('/api/login', {email, password})
    if (resposta)
      return resposta
    else
      throw new Error(resposta.message)
}

async function getLeads(page){

  let resposta = await executaGet('/api/leads?page='+page)
  if (resposta)
    return resposta
  else
    throw new Error(resposta.message)
}

async function fazImportacao(dados){

  let resposta = await executaPost('/api/importacao/importar', dados)
  if (resposta)
    return resposta
  else
    throw new Error(resposta.message)
}

function executaPost(caminho, dados) {
    
    const params = {
      method: 'Post',
      headers: {
        'content-type': 'application/json',
        'Authorization': 'Basic ' + JSON.parse(localStorage.getItem('credenciais')).credenciais
      },
      body: JSON.stringify(dados)
    }
  
    return window.fetch(caminho, params)
      .then(resposta => {
        if (!resposta.ok)
          throw new Error('Falha na comunicação com servidor')
        return resposta
      })
      .then(resposta => resposta.json())
  }

function executaGet (caminho) {

    const params = {
      method: 'GET',
      headers: {
        'content-type': 'application/json',
        'Authorization': 'Basic ' + JSON.parse(localStorage.getItem('credenciais')).credenciais
      }
    }
    return window.fetch(`${caminho}`, params)
      .then(resposta => {
        if (!resposta.ok)
          throw new Error('Falha na comunicação com servidor')
        return resposta
      })
      .then(resposta => resposta.json())
}

  export {executaPost, executaGet, fazLogin, fazImportacao, getLeads}
  