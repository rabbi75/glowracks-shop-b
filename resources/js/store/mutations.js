//  Add To Cart Section
export const ADD_TO_CART = (state,{product,quantity})=>{
	let productInCart = state.cart.find(item =>{
		return item.product.id == product.id;
	});
	if(productInCart){
		productInCart.quantity++;
		return;
	}
	state.cart.push({
		product,quantity	
	});
}
export const SET_CART = (state, cartItems) => {
	state.cart = cartItems;
}
export const REMOVE_TO_CART = (state,product)=>{
	state.cart = state.cart.filter(item => {
		return item.product.id !==product.id;
	})
}
export const INCREMENT_TO_CART = (state,product)=>{
	let productInCart = state.cart.find(item =>{
		return item.product.id === product.id;
	});
	if(productInCart){
		productInCart.quantity++;
		return;
	}
	state.cart.push({
		product,quantity	
	})
}
export const DECREMENT_TO_CART = (state,product)=>{
	let productInCart = state.cart.find(item =>{
		return item.product.id === product.id;
	});
	if(productInCart){
		productInCart.quantity--;
		return;
	}
	state.cart.push({
		product,quantity	
	})
}


//  Add To Wishlist Section
export const ADD_TO_WISHLIST = (state,{product,quantity})=>{
	let wishlistCart = state.wishlist.find(item =>{
		return item.product.id == product.id;
	});
	if(wishlistCart){
		wishlistCart.quantity++;
		return;
	}
	state.wishlist.push({
		product,quantity	
	})
}
export const SET_WISHLIST = (state, wishlistItems) => {
	state.wishlist = wishlistItems;
}
export const REMOVE_TO_WISHLIST = (state,product)=>{
	state.wishlist = state.wishlist.filter(item => {
		return item.product.id !==product.id;
	})
}

//  Add To Compare Section
export const ADD_TO_COMPARE = (state,{product,quantity})=>{
	let compareCart = state.compare.find(item =>{
		return item.product.id == product.id;
	});
	if(compareCart){
		compareCart.quantity++;
		return;
	}
	state.compare.push({
		product,quantity	
	})
}
export const SET_COMPARE = (state, compareItems) => {
	state.compare = compareItems;
}

export const REMOVE_TO_COMPARE = (state,product)=>{
	state.compare = state.compare.filter(item => {
		return item.product.id !==product.id;
	})
}
export const SET_TOKEN = (state,token)=>{
	state.token = token;
}
export const CLEAR_TOKEN = (state)=>{
	state.token = '';
}
