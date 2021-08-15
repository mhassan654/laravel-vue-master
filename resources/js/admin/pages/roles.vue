<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Roles Management</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Roles</li>
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
                                    Roles Management &nbsp;
                                    <Button @click="addModal = true"
                                    >
                                        <Icon type="primary"/>
                                        Add New Role
                                    </Button
                                    >
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
                                            <th>ID</th>
                                            <th>Role Name</th>
<!--                                            <th>Role Permission</th>-->
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(role, i) in roles" :key="i" v-if="roles.length">
                                            <td>
                                                {{ role.id }}
                                            </td>
                                            <td>{{ role.roleName }}</td>
                                            <td>
                                                {{ role.created_at }}
                                            </td>

                                            <td>
                                                <Button
                                                    type="info"
                                                    size="small"
                                                    @click="showEditModal(role, i)"
                                                >Edit
                                                </Button
                                                >
                                                <Button
                                                    type="error"
                                                    size="small"
                                                    @click="showDeletingModal(role, i)"
                                                    :loading="role.isDeleting"
                                                >Delete
                                                </Button
                                                >
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Add New Tag</a> -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

            <!-- add role -->
            <Modal
                v-model="addModal"
                title="Add Role"
                :mask-closable="false"
                :closable="false"
            >
                <div class="spacer">
                    <Input v-model="data.roleName" placeholder="Enter role name"/>

                </div>
<!--                <div class="spacer">-->

<!--                    <Input v-model="data.permission" placeholder="Enter permission"/>-->
<!--                </div>-->


                <div slot="footer">
                    <Button type="default" @click="addModal = false">Close</Button>
                    <Button
                        type="primary"
                        @click="addRole"
                        :disabled="isAdding"
                        :loading="isAdding"
                    >{{ isAdding ? "Adding.." : "Add Role" }}
                    </Button
                    >
                </div>
            </Modal>

            <!-- edit tag -->
            <Modal
                v-model="editModal"
                title="Edit Role"
                :mask-closable="false"
                :closable="false"
            >
                <Input v-model="editData.roleName" placeholder="Enter role name"/>

                <div slot="footer">
                    <Button type="default" @click="editModal = false">Close</Button>
                    <Button
                        type="primary"
                        @click="editRole"
                        :disabled="isAdding"
                        :loading="isAdding"
                    >{{ isAdding ? "Editing.." : "Edit Role" }}
                    </Button
                    >
                </div>
            </Modal>

            <!-- delte tag modal -->

            <!--/. container-fluid -->
            <deleteModal></deleteModal>
        </section>
        <!-- /.content -->
    </div>
    <!-- tag adding modal -->
</template>

<script>
import {mapGetters} from 'vuex';
import deleteModal from "../components/deleteModal.vue";

export default {
    data() {
        return {
            data: {
                roleName: "",

            },
            addModal: false,
            editModal: false,
            isAdding: false,
            roles: [],
            editData: {
                roleName: "",

            },
            index: -1,
            showDeleteModal: false,
            isDeleting: false,
            deleteItem: {},
            deletingIndex: -1,
        };
    },

    methods: {
        async addRole() {
            if (this.data.roleName.trim() == "")
                return this.error("Role name is required");

            const res = await this.callApi("post", "app/create_role", this.data);
            if (res.status === 201) {
                this.roles.unshift(res.data);
                this.success("Role has been added successfully!");
                this.addModal = false;
                this.data.roleName = "";
                this.data.permission = "";
            } else {
                if (res.status === 422) {
                    if (res.data.errors.roleName) {
                        this.error(res.data.errors.roleName[0]);
                    }
                } else {
                    this.smwr();
                }
            }
        },

        // edit tag
        async editRole() {
            if (this.editData.roleName.trim() == "")
                return this.error("Role name is required");
            const res = await this.callApi("post", "app/edit_role", this.editData);
            if (res.status === 200) {
                this.roles[this.index].roleName = this.editData.roleName;
                this.success("Tag has been updated successfully!");
                this.editModal = false;
            } else {
                if (res.status === 422) {
                    if (res.data.errors.roleName) {
                        this.error(res.data.errors.roleName[0]);
                    }
                } else {
                    this.smwr();
                }
            }
        },
        showEditModal(role, index) {
            let obj = {
                id: role.id,
                roleName: role.roleName,
            };
            this.editData = obj;
            this.editModal = true;
            this.index = index;
        },

        showDeletingModal(role, i) {
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: 'app/delete_role',
                data: role,
                deletingIndex: i,
                isDeleted: false,
            }
            this.$store.commit('setDeletingModalObj', deleteModalObj)

        },
    },

    async created() {
        const res = await this.callApi("get", "app/get_roles");
        if ((res.status = 200)) {
            this.roles = res.data;
        } else {
            this.smwr();
        }
    },

    components: {
        deleteModal,
    },
    computed: {
        ...mapGetters(['getDeleteModalObj'])
    },
    watch: {
        getDeleteModalObj(obj) {

            if (obj.isDeleted) {
                this.roles.splice(obj.deletingIndex, 1)
            }
        }

    }
};
</script>
