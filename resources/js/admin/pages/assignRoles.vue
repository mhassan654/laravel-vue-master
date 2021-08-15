<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Assign Roles</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Assign Roles</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->

                <div class="row">
                    <div class="col-md-12">
                        <!-- MAP & BOX PANE -->
                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">
                                    Assign Roles &nbsp;

                                        <Select v-model="data.id" placeholder="select admin type" style="width:300px" @on-change="changeAdmin">
                                            <Option :value="role.id" v-for="(role, i) in roles" :key="i" v-if="roles.length">{{role.roleName}}</Option>
                                        </Select>
                                </h3>

                                <div class="card-tools">
                                    <button
                                        type="button"
                                        class="btn btn-tool"
                                        data-card-widget="collapse"
                                    >
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-tool"
                                        data-card-widget="remove"
                                    >
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0 table-striped">
                                        <thead>
                                        <tr>
                                            <th>Resource name</th>
                                            <th>Read</th>
                                            <th>Write</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(r, i) in resources" :key="i">
                                          <td>{{r.resourceName}}</td>
                                            <td><Checkbox v-model="r.read"></Checkbox></td>
                                            <td><Checkbox v-model="r.write"></Checkbox></td>
                                            <td><Checkbox v-model="r.update"></Checkbox></td>
                                            <td><Checkbox v-model="r.delete"></Checkbox></td>


                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="card-footer clearfix">

                                <Button

                                  type="primary" :loading="isSending" :disabled="isSending"
                                    @click="assignRoles"
                                >Assign</Button
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</template>

<script>


export default {
    data() {
        return {
            data: {
                roleName: "",
                id:null

            },
            isSending:false,
            roles:[],
            resources:[
                {resourceName:'Home', read:false, update:false, delete:false, name:'/'},
                {resourceName:'Tags', read:true, update:false, delete:false, name:'tags'},
                {resourceName:'Blog', read:false, update:false, delete:false, name:'blog'},
                 {resourceName:'Blogdata', read:false, update:false, delete:false, name:'blogdata'},
                {resourceName:'Category', read:false, update:false, delete:false, name:'category'},
               {resourceName:'Admin-users', read:false, update:false, delete:false, name:'admin-users'},
               {resourceName:'Roles', read:false, update:false, delete:false, name:'roles'},
               {resourceName:'AssignRoles', read:false, update:false, delete:false, name:'assignRoles'},
           ],
            defaultResourcesPermission:[
                {resourceName:'Home', read:false, update:false, delete:false, name:'/'},
                {resourceName:'Blog', read:false, update:false, delete:false, name:'blog'},
                {resourceName:'Blogdata', read:false, update:false, delete:false, name:'blogdata'},
                {resourceName:'Tags', read:true, update:false, delete:false, name:'tags'},
                {resourceName:'Category', read:false, update:false, delete:false, name:'category'},
                {resourceName:'Admin-users', read:false, update:false, delete:false, name:'admin-users'},
                {resourceName:'Roles', read:false, update:false, delete:false, name:'roles'},
                {resourceName:'AssignRoles', read:false, update:false, delete:false, name:'assignRoles'},
            ]
        };
    },

    methods: {
async assignRoles(){
    // console.log(this.resources)
   let data = JSON.stringify(this.resources)
    const res = await this.callApi("post", "app/assign_roles",{'permission' : data, id: this.data.id})
    if(res.status==200){
        this.success('Role has been assigned successfully!')
        let index = this.roles.findIndex(role => role.id == this.data.id)
        this.roles[index].permission = data

    }else{
        this.smwr()
    }
},
        changeAdmin(){
    let index = this.roles.findIndex(role => role.id == this.data.id)
            let permission = this.roles[index].permission
           if(!permission){
               this.resources = this.defaultResourcesPermission
           }else{
               this.resources = JSON.parse(permission)
           }
           console.log(permission)
        }
    },

    async created() {
        const res = await this.callApi("get", "app/get_roles");
        if ((res.status == 200)) {
            this.roles = res.data;
            if(res.data.length){
                this.data.id=res.data[0].id
                if(res.data[0].permission){
                    this.resources = JSON.parse(res.data[0].permission)
                }
            }
        } else {
            this.smwr();
        }
    },
};
</script>
