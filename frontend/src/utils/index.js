let retries = 0;
let connection_error = false;

export const fetch = ({ method = "get", url, data = {}, params = null }) => {
  return axios({ method, url, data, params })
    .then(res => {
      if (connection_error) {
        connection_error = false;
        PNotify.success('Conexiòn restablecida');
      }
      return [null, res.data];
    })
    .catch(err => {
      if (err.response) {
        const { status } = err.response;
        if (retries < 3 && status == 500) {
          retries++;
          return fetch({ method, url, data, params })
        }
        retries = 0;
      } else {
        connection_error = true;
        PNotify.error('Ocurrio un problema en la red... Reintenta en unos segundos');
      }
      return [err]
    });
}

export const setStateStorage = (state, newState) => {
  Object.keys(newState).forEach(key => {
    if(typeof newState[key] === 'object') {
      state[key] = Object.assign({}, newState[key]);
      localStorage[key] = JSON.stringify(newState[key]);
    } else {
      state[key] = newState[key];
      localStorage[key] = newState[key];
    }
  });
}