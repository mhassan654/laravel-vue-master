<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tags</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tags</li>
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
                  Tags &nbsp;
                  <Button @click="addModal = true"
                          v-if="canWrite"
                    ><Icon type="primary" />Add Tag</Button
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
                        <th>Name</th>
                        <th>Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(tag, i) in tags" :key="i" v-if="tags.length">
                        <td>
                          {{ tag.id }}
                        </td>
                        <td>{{ tag.tagName }}</td>
                        <td>
                          {{ tag.created_at }}
                        </td>

                        <td>
                          <Button
                            type="info"
                            size="small"
                            @click="showEditModal(tag, i)"
                            v-if="canUpdate"
                          >Edit</Button
                          >
                          <Button
                            type="error"
                            size="small"
                            @click="showDeletingModal(tag, i)"
                            :loading="tag.isDeleting"
                            v-if="canDelete"
                          >Delete</Button
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

                <a
                  href="javascript:void(0)"
                  class="btn btn-sm btn-secondary float-right"
                  >View All Tags</a
                >
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
        title="Add Tag"
        :mask-closable="false"
        :closable="false"
      >
        <Input v-model="data.tagName" placeholder="Enter tag name" />

        <div slot="footer">
          <Button type="default" @click="addModal = false">Close</Button>
          <Button
            type="primary"
            @click="addTag"
            :disabled="isAdding"
            :loading="isAdding"
            >{{ isAdding ? "Adding.." : "Add Tag" }}</Button
          >
        </div>
      </Modal>

      <!-- add tag -->
      <Modal
        v-model="editModal"
        title="Edit Tag"
        :mask-closable="false"
        :closable="false"
      >
        <Input v-model="editData.tagName" placeholder="Enter tag name" />

        <div slot="footer">
          <Button type="default" @click="editModal = false">Close</Button>
          <Button
            type="primary"
            @click="editTag"
            :disabled="isAdding"
            :loading="isAdding"
            >{{ isAdding ? "Editing.." : "Edit Tag" }}</Button
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
import { mapGetters } from 'vuex';
import deleteModal from "../components/deleteModal.vue";

export default {
  data() {
    return {
      data: {
        tagName: "",
      },
      addModal: false,
      editModal: false,
      isAdding: false,
      tags: [],
      editData: {
        tagName: "",
      },
      index: -1,
      showDeleteModal: false,
      isDeleting: false,
      deleteItem: {},
      deletingIndex: -1,
    };
  },

  methods: {
    async addTag() {
      if (this.data.tagName.trim() == "")
        return this.error("Tag name is required");
      const res = await this.callApi("post", "app/create_tag", this.data);
      if (res.status === 201) {
        this.tags.unshift(res.data);
        this.success("Tag has been added successfully!");
        this.addModal = false;
        this.data.tagName = "";
      } else {
        if (res.status === 422) {
          if (res.data.errors.tagName) {
            this.error(res.data.errors.tagName[0]);
          }
        } else {
          this.smwr();
        }
      }
    },

    // edit tag
    async editTag() {
      if (this.editData.tagName.trim() == "")
        return this.error("Tag name is required");
      const res = await this.callApi("post", "app/edit_tag", this.editData);
      if (res.status === 200) {
        this.tags[this.index].tagName = this.editData.tagName;
        this.success("Tag has been updated successfully!");
        this.editModal = false;
      } else {
        if (res.status === 422) {
          if (res.data.errors.tagName) {
            this.error(res.data.errors.tagName[0]);
          }
        } else {
          this.smwr();
        }
      }
    },
    showEditModal(tag, index) {
      let obj = {
        id: tag.id,
        tagName: tag.tagName,
      };
      this.editData = obj;
      this.editModal = true;
      this.index = index;
    },

    showDeletingModal(tag, i) {
      const   deleteModalObj = {
            showDeleteModal: true,
            deleteUrl: 'app/delete_tag',
            data: tag,
            deleteingIndex: i,
            isDeleted: false,
        }
        this.$store.commit('setDeletingModalObj', deleteModalObj)

    },
  },

  async created() {

    const res = await this.callApi("get", "app/get_tags");
    if ((res.status = 200)) {
      this.tags = res.data;
    } else {
      this.smwr();
    }
  },

  components: {
    deleteModal,
  },
  computed:{
      ...mapGetters(['getDeleteModalObj'])
  },
  watch:{
      getDeleteModalObj(obj){

          if(obj.isDeleted){
              this.tags.splice(obj.deletingIndex, 1)
          }
      }

  }
};
</script>
