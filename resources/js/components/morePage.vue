<template>
	<div>
        <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                        <sidebar></sidebar>
                        <li><router-link :to="{name:'home'}"><i class="fa fa-home"></i> Home</router-link></li>
                        <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                        <li><a>More Page</a></li>
                        <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                        <li><a v-if="content != null">{{content.title}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
        <section class="productarea about-area section-padding">
        <div class="container">
            <div class="row light_bg">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="content-page" v-if="content != null">
                        <div class="single-page">
                            <h5 style="margin-bottom: 20px;">{{content.title}}</h5>
                           <p>{{content.text}}</p>
                        </div>
                    </div>
                </div>
                <!--row end-->
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
                content: {},
            }
        },
        methods:{
            loadData(){
                let slug = this.$route.params.slug;
                axios.get('api/v1/more/'+slug).then(response => {
                  this.content = response.data.content;
                });
            }
        },
        mounted(){
            this.loadData();
        },
        watch:{
            $route(){
                this.loadData();
            }
        }
    }
</script>