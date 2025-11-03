import api from "../plugins/axios";


export const syncUser = () => {

     
    let response = api.get('/api/auth/profile');
     
    return response;

                // .then((res) => {
                            
                

                // }).catch((error) => {

                //     if (error?.response?.data?.message) {
                //         alert(error.response.data.message);
                //     }else{
                //         // alert('Something Went Wrong');
                //     }
                //     this.loading = false;
                        
                // });


        //    this.userStore.$subscribe((mutation, state) => {

           
        //     console.log('New state:', state.user)


        // });

        // this.userStore.syncUser();
       


}












export default {
    syncUser
}