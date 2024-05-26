<template>
	<div>
        <!--custom breadcrumb end-->
        <section class="section-padding">
           <div class="container">
             <div class="row justify-content-center">
               <div class="col-lg-6 col-md-6 col-sm-6">
                   <div class="card">
                       <div class="card-header">
                            <h6>Order Track Result #{{orderinfo.trackingId}}  </h6>
                       </div>
                       <div class="card-body">
                            <div class="row addpercel-inner">
                                <div class="col-sm-12">
                                    <div class="track-left">
                                         <div class="tracking-step" v-for="(value,index) in orderinfo.ordernotes">
                                            <div class="tracking-step-left">
                                                <strong>{{value.updated_at}}</strong>
                                                <p>{{value.created_at}}</p>
                                            </div>
                                            <div class="tracking-step-right">
                                                <p>{{value.note}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <!-- col end -->
             </div>
           </div>
        </section>
	</div>
</template>
<script>
   import sidebar from '../components/includes/sidebar'
    export default {
        components: {
            sidebar,
        },
        data(){
            return {
                orderinfo: {},
            }
        },
        methods:{
            loadData(){
                let id = this.$route.params.id;
                axios.get('api/v1/track/order/result/'+id).then(response => {
                     this.orderinfo = response.data.orderinfo;
                });
            }
        },
        mounted(){
            this.loadData();
        }
    }
</script>