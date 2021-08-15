<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admins</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admins</li>
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
                  Admins &nbsp;
                  <Button @click="addModal = true"
                          v-if="canWrite"><Icon type="primary" />Add Admins</Button
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
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>User Type</th>

                        <th>Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(admin, i) in admins"
                        :key="i"
                        v-if="admins.length"
                      >
                        <td>
                          {{ admin.id }}
                        </td>
                        <td>{{ admin.fullName }}</td>
                        <td>{{ admin.email }}</td>
                        <td>{{ admin.userType }}</td>
                        <td>
                          {{ admin.created_at }}
                        </td>

                        <td>
                          <Button
                            type="info"
                            size="small"
                            @click="showEditModal(admin, i)"
                            v-if="canUpdate">Edit</Button
                          >
                          <Button
                            type="error"
                            size="small"
                            @click="showDeletingModal(admin, i)"
                            :loading="admin.isDeleting"
                            v-if="canDelete">Delete</Button
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

<!--                <a-->
<!--                  href="javascript:void(0)"-->
<!--                  class="btn btn-sm btn-secondary float-right"-->
<!--                  >View All Tags</a-->
<!--                >-->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

      <!-- add tag -->
      <Modal
        v-model="addModal"
        title="Add Admin"
        :mask-closable="false"
        :closable="false"
      >
        <div class="spacer">
          <Input v-model="data.fullName" placeholder="Enter full name" />
        </div>
        <div class="spacer">
          <Input v-model="data.email" placeholder="Enter email" />
        </div>
        <div class="spacer">
          <Input v-model="data.password" placeholder="Enter password" />
        </div>
        <!-- <div class="spacer">
        <Input v-model="data.userName" placeholder="Enter user name" />

          </div> -->
        <div class="spacer">
          <Select v-model="data.role_id" placeholder="select admin type">
            <Option :value="role.id" v-for="(role, i) in roles" :key="i">{{role.roleName}}</Option>

          </Select>
        </div>

        <div slot="footer">
          <Button type="default" @click="addModal = false">Close</Button>
          <Button
            type="primary"
            @click="addAdmin"
            :disabled="isAdding"
            :loading="isAdding"
            >{{ isAdding ? "Adding.." : "Add Admin User" }}</Button
          >
        </div>
      </Modal>

      <!-- add tag -->
      <Modal
        v-model="editModal"
        title="Edit User"
        :mask-closable="false"
        :closable="false"
      >
        <div class="spacer">
          <Input v-model="editData.fullName" placeholder="Enter full name" />
        </div>
        <div class="spacer">
          <Input v-model="editData.email" placeholder="Enter email" />
        </div>
        <div class="spacer">
          <Input v-model="editData.password" placeholder="Enter password" />
        </div>
        <!-- <div class="spacer">
        <Input v-model="editData.userName" placeholder="Enter user name" />

          </div> -->
        <div class="spacer">
          <Select v-model="editData.role_id" placeholder="select admin type">
            <Option :value="role.id" v-for="(role, i) in roles" :key="i">{{role.roleName}}</Option>

          </Select>
        </div>

        <div slot="footer">
          <Button type="default" @click="editModal = false">Close</Button>
          <Button
            type="primary"
            @click="editUser"
            :disabled="isAdding"
            :loading="isAdding"
            >{{ isAdding ? "Editing.." : "Edit User" }}</Button
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
import { mapGetters } from "vuex";
import deleteModal from "../components/deleteModal.vue";

export default {
  data() {
    return {
      data: {
        fullName: "",
        email: "",
        password: "",
          role_id:null
      },
      addModal: false,
      editModal: false,
      isAdding: false,
      admins: [],
      editData: {
        fullName: '',
        email: '',
        password: '',
      role_id:null
      },
      index: -1,
      showDeleteModal: false,
      isDeleting: false,
      deleteItem: {},
      deletingIndex: -1,
        roles:[]
    };
  },

  methods: {
    async addAdmin() {
      if (this.data.fullName.trim() == "")
        return this.error("full name is required");
      if (this.data.email.trim() == "") return this.error("Email is required");
      if (this.data.password.trim() == "")
        return this.error("Password is required");
      if (!this.data.role_id)
        return this.error("Role Id is required");
      const res = await this.callApi("post", "/app/create_user", this.data);
      if (res.status === 201) {
        this.admins.unshift(res.data);
        this.success("Admin has been added successfully!");
        this.addModal = false;
        this.data.fullName = "";
        this.data.email = "";
        this.data.password = "";
        this.data.role_id = "";
      } else {
        if (res.status === 422) {
          // console.log(res.data.errors)
          if (res.data.errors.fullName) {
            this.error(res.data.errors.fullName[0]);
          }
          if (res.data.errors.email) {
            this.error(res.data.errors.email[0]);
          }
          if (res.data.errors.password) {
            this.error(res.data.errors.password[0]);
          }
          if (res.data.errors.role_id) {
            this.error(res.data.errors.role_id);
          }
        } else {
          this.smwr();
        }
      }
    },

    // edit tag
    async editUser() {
      if (this.editData.fullName.trim() == '') return this.error("full name is required")
      if (this.editData.email.trim() == '') return this.error("Email is required")
      if (!this.editData.role_id)
        return this.error("User type is required")
      const res = await this.callApi("post", "app/edit_user", this.editData);
      if (res.status === 200) {
        this.admins[this.index] = this.editData;
        this.success("User has been updated successfully!");
        this.editModal = false;
      } else {
        if (res.status ==422) {
          for(let i in res.data.errors){
              this.error(res.data.errors[i][0])
          }
        } else {
          this.smwr();
        }
      }
    },
    showEditModal(admin, index) {
      let obj = {
        id: admin.id,
        fullName: admin.fullName,
        email: admin.email,
        password: admin.password,
        userType: admin.userType,
      };
      this.editData = obj;
      this.editModal = true;
      this.index = index;
    },

    showDeletingModal(tag, i) {
      const deleteModalObj = {
        showDeleteModal: true,
        deleteUrl: "app/delete_tag",
        data: tag,
        deleteingIndex: i,
        isDeleted: false,
      };
      this.$store.commit("setDeletingModalObj", deleteModalObj);
    },
  },

  async created() {
      const [res, resRole] = await Promise.all([
          this.callApi("get", "app/get_users"),
          this.callApi("get", "app/get_roles")
      ])

    if ((res.status = 200)) {
      this.admins = res.data;
    } else {
      this.smwr();
    }
      if ((resRole.status = 200)) {
          this.roles = resRole.data;
      } else {
          this.smwr();
      }
  },

  components: {
    deleteModal,
  },
  computed: {
    ...mapGetters(["getDeleteModalObj"]),
  },
  watch: {
    getDeleteModalObj(obj) {
      if (obj.isDeleted) {
        this.admins.splice(obj.deletingIndex, 1);
      }
    },
  },
};
</script>
