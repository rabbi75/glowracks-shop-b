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
                    <li><a>Feedback</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="feedback-section">	
			<div class="container">
				<div class="row">
					<div class="col-sm-6" v-for="(value,index) in feedbacks">	
						<div class="client-feedback">
							<div class="testimonial-item">
                                   <div class="client-img">
                                       <img :src="value.image" alt="">
                                   </div>
                                   <div class="clientName">
                                       <p>{{value.name}}</p>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star-half"></i>
                                   </div>
                                   <div class="client_comment">
                                       <p>{{value.description}}</p>
                                   </div>
                                </div>
						</div>
					</div>
				</div>
			</div>			
    </div>	
	</div>	
</template>

<script>
 import sidebar from '../components/includes/sidebar';
    export default {
        components: {
            sidebar,
        },
        data(){
            return {
                feedbacks: [],
            }
        },
        methods:{
            loadData(){
                axios.get('/api/v1/client-feedback').then(response => {
                    this.feedbacks = response.data.feedbacks;
                });
            }
        },
        mounted(){
            this.loadData();
        }
    }
</script>