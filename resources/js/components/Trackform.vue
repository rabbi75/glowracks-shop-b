<template>
	<div>
        <!--custom breadcrumb end-->
        <section class="section-padding">
           <div class="container">
             <div class="row justify-content-center">
               <div class="col-lg-4 col-md-6 col-sm-6 col-8">
                    <div class="trackform">
                        <h2 class="login-title">Order Track Form </h2>
                        <form @submit.prevent="login">
                            <!-- form group -->
                            <div class="form-group">
                                <label for="trackId">Tracking ID</label>
                                <input type="text" name="trackId" v-model="trackForm.trackId" class="form-control">
                                <div v-if="trackForm.errors.has('trackId')" v-html="trackForm.errors.get('trackId')" />
                            </div>
                            <button  type="submit" >Submit</button>
                        </form>
                    </div>
                    <!--login content end-->
                </div>
                <!-- col end -->
             </div>
           </div>
        </section>
	</div>
</template>
<script>
import Form from 'vform'
import sidebar from './includes/sidebar'
export default {
	components: {
    	sidebar,
    },
    data: () => ({
        trackForm: new Form({
            trackId: '',
        }),
    }),
    methods: {
        async login () {
            const response = await this.trackForm.post('/api/v1/track/order').then(response=>{
                if(response.data.status=='success'){
                    this.$router.push({name:'trackresult', params:{id:response.data.orderinfo.trackingId}});
                }else{
                    this.$toast.error({
                        title:'Opps!',
                        message:'Your order track ID does"t match.'
                    });
                }
            })
        }
    }
};
</script>