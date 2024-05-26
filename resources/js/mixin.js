
import { mapActions } from "vuex";
import storeIndex from './store/index';

export default{
  storeIndex
}

// Add To Cart Section
export const  AddToCart = {
    methods:{
        AddToCart(product){
          this.$store.dispatch("addProductToCart",{
            product: product,
            quantity : 1
          });
          this.$toast.success({
            title:'Success!',
                message:'Product added to cart'
            });
        },
    },

}
export const  RemoveToCart = {
    methods:{
        RemoveToCart(product){
          this.$store.dispatch("RemoveToCart",product);
        },
    },

}
export const  IncrementToCart = {
    methods:{
        IncrementToCart(product){
          this.$store.dispatch("IncrementToCart",product);
        },
    },

}
export const  DecrementToCart = {
    methods:{
        DecrementToCart(product){
          this.$store.dispatch("DecrementToCart",product);
        },
    },

}


// Add To Wishlist Section
export const  AddToWishlist = {
    methods:{
        AddToWishlist(product){
          this.$store.dispatch("AddToWishlist",{
            product: product,
            quantity : 1
          });
          this.$toast.success({
            title:'Success!',
                message:'Product added to wishlist'
            });
        },
    },

}

export const  RemoveToWishlist = {
    methods:{
        RemoveToWishlist(product){
          this.$store.dispatch("RemoveToWishlist",product);
        },
    },

}

// Add To Compare Section
export const  AddToCompare = {
    methods:{
        AddToCompare(product){
          this.$store.dispatch("AddToCompare",{
            product: product,
            quantity : 1
          });
          this.$toast.success({
            title:'Success!',
                message:'Product added to compare'
            });
        },
    },

}
export const  RemoveToCompare = {
    methods:{
        RemoveToCompare(product){
          this.$store.dispatch("RemoveToCompare",product);
        },
    },

}

export const  SidebarFilter = {
    methods:{
        SidebarFilter(){
             console.log('hi');
              $('.filtersidebar').toggleClass('active');
              $('.overlay').toggleClass('active');
        },
    },

}