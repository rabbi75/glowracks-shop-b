import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
window.axios = require('axios');
import VueRouter from 'vue-router'

// Add To Cart Section
export const addProductToCart = ({commit},{product,quantity})=>{
	commit('ADD_TO_CART',{product,quantity});
	axios.post('/api/v1/cart',{ 
		product_id: product.id,
		quantity
	})
}
export const getCartitems = ({commit}) => {
	axios.get('/api/v1/cart')
	.then(response => {
		commit('SET_CART', response.data);
	})
}
export const RemoveToCart = ({commit},product) => {
	commit('REMOVE_TO_CART',product);
	axios.delete('/api/v1/cart/delete/'+product.id);
}

export const IncrementToCart = ({commit},product) => {
	commit('INCREMENT_TO_CART',product);
	axios.put('/api/v1/cart/increment/'+product.id);
}
export const DecrementToCart = ({commit},product) => {
	commit('DECREMENT_TO_CART',product);
	axios.put('/api/v1/cart/decrement/'+product.id);
}

// Add To Wishlist Section
export const AddToWishlist = ({commit},{product,quantity})=>{
	commit('ADD_TO_WISHLIST',{product,quantity});
	axios.post('/api/v1/wishlist',{ 
		product_id: product.id,
		quantity
	});
}
export const getWishitems = ({commit}) => {
	axios.get('/api/v1/wishlist')
	.then(response => {
		commit('SET_WISHLIST', response.data);
	})
}
export const RemoveToWishlist = ({commit},product) => {
	commit('REMOVE_TO_WISHLIST',product);
	axios.delete('/api/v1/wishlist/delete/'+product.id);
}

// Add To Compare
export const AddToCompare = ({commit},{product,quantity})=>{
	commit('ADD_TO_COMPARE',{product,quantity});
	axios.post('/api/v1/compare',{ 
		product_id: product.id,
		quantity
	});
}
export const getCompareitems = ({commit}) => {
	axios.get('/api/v1/compare')
	.then(response => {
		commit('SET_COMPARE', response.data);
	})
}
export const RemoveToCompare = ({commit},product) => {
	commit('REMOVE_TO_COMPARE',product);
	axios.delete('/api/v1/compare/delete/'+product.id);
}
export const isLoggedIn = ({commit}) => {
	let token = (localStorage.getItem('token'));
	commit('SET_TOKEN',token);
}
export const Logout = ({commit}) => {
	commit('CLEAR_TOKEN');
}


