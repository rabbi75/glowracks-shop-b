<template>
	<div>
		<ul>
		    <li class="active"><router-link :to="{name:'customeraccount'}"><i class="fa fa-user"></i>My Account</router-link></li>
		    <li><router-link :to="{name:'editprofile'}"><i class="fa fa-shopping-bag"></i> Profile Edit</router-link></li>
		    <li><router-link :to="{name:'myorder'}"><i class="fa fa-shopping-bag"></i> My Order</router-link></li>

		    <li>
                <router-link :to="{name:'changepassword'}">
                  <i class="fa fa-cog" aria-hidden="true"></i> Change Password
                </router-link>
            </li>

            <li><a href="" @click.prevent="logout"><i class="fa fa-sign-out"></i>Logout</a></li>
    	</ul>
	</div>
</template>
<script>
    export default {  
        methods:{
            logout(){
                axios.post('/api/v1/customer/logout?token='+localStorage.getItem('token')).then(response=>{
                    if(response.data.status=='success'){
                    	this.$toast.success({
                            title:'Success!',
                            message:'You are logged in successfully.'
                        });
                        localStorage.removeItem('token');
                        this.$store.dispatch("Logout");
                        this.$router.push({name:'login'});
                        
                    }else{
                        this.$toast.error({
                        title:'Opps!',
                        message:'Your token does not match.'
                    });
                    }
                })
            }
        },
    }
</script>