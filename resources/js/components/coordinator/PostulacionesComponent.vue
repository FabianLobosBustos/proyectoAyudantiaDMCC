<template>
    <div class="container">
        <table class="card s12 striped responsive-table">
            <thead> 
            <tr>
                <th>Name</th>
                <th>Item Name</th>
                <th>Item Price</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Alvin</td>
                <td>Eclair</td>
                <td>$0.87</td>
            </tr>
            <tr>
                <td>Alan</td>
                <td>Jellybean</td>
                <td>$3.76</td>
            </tr>
            <tr>
                <td>Jonathan</td>
                <td>Lollipop</td>
                <td>$7.00</td>
            </tr>
            </tbody>
        </table>
      </div>
    

</template>

<style scoped>
    .container{
      height: 150px;
    }
    .input-field{
      top: 30px;
    }
</style>

<script>
  
    export default {
        data(){
            return {
                search: null,
                searched: [],
                users: [
                    {
                    id: 1,
                    name: "Shawna Dubbin",
                    email: "sdubbin0@geocities.com",
                    gender: "Male",
                    title: "Assistant Media Planner"
                    },
                    {
                    id: 2,
                    name: "Odette Demageard",
                    email: "odemageard1@spotify.com",
                    gender: "Female",
                    title: "Account Coordinator"
                    }]
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            newUser () {
                window.alert('Noop')
            },
            searchOnTable () {
                this.searched = searchByName(this.users, this.search)
            }
            },
            created () {
                this.searched = this.users
            }
        }
</script>