
export const cartItemCount = (state)=>{
	return state.cart.length;
}

export const cartTotalPrice = (state)=>{
	let total = 0;
	state.cart.forEach(item =>{
		total += item.product.proNewprice*item.quantity;
	})
	return total;
}
export const wishlistCount = (state)=>{
	return state.wishlist.length;
}
export const compareCount = (state)=>{
	return state.compare.length;
}
export const isLogged = (state)=>{
	return state.token;
}