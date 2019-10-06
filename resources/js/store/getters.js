export default {
  isLogged() {
    const token = localStorage.getItem('token');

    return token;
  },
};