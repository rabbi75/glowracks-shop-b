import store from "./store";


const isLogged = () => store.state.token

export default (to, from, next) => {
  let token = localStorage.getItem('token');
  if ((to.meta.auth == true) && token == null) {
      next('customer/login')
  } else if ((to.meta.auth == true) && !isLogged()) {
    next()
  }else{
    next()
  }
}