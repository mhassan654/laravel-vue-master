<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                  Category &nbsp;
                  <Button @click="addModal = true"
                          v-if="canWrite"
                  ><Icon type="primary" />Add Category</Button
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
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(category, i) in categories"
                        :key="i"
                        v-if="categories.length"
                      >
                        <td>
                          {{ category.id }}
                        </td>
                        <td>{{ category.categoryName }}</td>
                        <td>
                          <img
                            class=""
                            :src="category.iconImage"
                            width="100"
                            height="100"
                          />
                        </td>
                        <td>
                          {{ category.created_at }}
                        </td>

                        <td>
                          <Button
                            type="info"
                            size="small"
                            @click="showEditModal(category, i)"
                            v-if="canUpdate"
                          >Edit</Button
                          >
                          <Button
                            type="error"
                            size="small"
                            @click="showDeletingModal(category, i)"
                            :loading="category.isDeleting"
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
        title="Add Category"
        :mask-closable="false"
        :closable="false"
      >
        <Input v-model="data.categoryName" placeholder="Enter category name" />
        <div class="space"></div>

        <Upload
          refs="uploads"
          type="drag"
          :headers="{
            'x-csrf-token': token,
            'X-Requested-with': 'XMLHttpRequest',
          }"
          :on-success="handleSuccess"
          :on-error="handleError"
          :format="['jpg', 'jpeg', 'png']"
          :max-size="2048"
          :on-format-error="handleFormatError"
          :on-exceed-size="handleMaxSize"
          action="/app/upload"
        >
          <div style="padding: 20px 0">
            <Icon
              type="ios-cloud-upload"
              size="52"
              style="color: #3399ff"
            ></Icon>
            <p>Click or drag files here to upload</p>
          </div>
        </Upload>

        <div class="demo-upload-list" v-if="data.iconImage">
          <img :src="data.iconImage" width="100" height="100" />
          <div class="demo-upload-list-cover">
            <Icon type="ios-trash-outline" @click="deleteImage"></Icon>
          </div>
        </div>

        <div slot="footer">
          <Button type="default" @click="addModal = false">Close</Button>
          <Button
            type="primary"
            @click="addCategory"
            :disabled="isAdding"
            :loading="isAdding"
            >{{ isAdding ? "Adding.." : "Add Category" }}</Button
          >
        </div>
      </Modal>

      <!-- add Category -->
      <Modal
        v-model="editModal"
        title="Edit Category"
        :mask-closable="false"
        :closable="false"
      >
        <Input v-model="editData.categoryName" placeholder="Enter category name" />
        <div class="space"></div>

        <Upload
          v-show="isIconImageNew"
          refs="editDataUploads"
          type="drag"
          :headers="{
            'x-csrf-token': token,
            'X-Requested-with': 'XMLHttpRequest',
          }"
          :on-success="handleSuccess"
          :on-error="handleError"
          :format="['jpg', 'jpeg', 'png']"
          :max-size="2048"
          :on-format-error="handleFormatError"
          :on-exceed-size="handleMaxSize"
          action="/app/upload"
        >
          <div style="padding: 20px 0">
            <Icon
              type="ios-cloud-upload"
              size="52"
              style="color: #3399ff"
            ></Icon>
            <p>Click or drag files here to upload</p>
          </div>
        </Upload>

        <div class="demo-upload-list" v-if="editData.iconImage">
          <img :src="`${editData.iconImage}`" width="100" height="100" />
          <div class="demo-upload-list-cover">
            <Icon type="ios-trash-outline" @click="deleteImage(false)"></Icon>
          </div>
        </div>

        <div slot="footer">
          <Button type="default" @click="closeEditModal">Close</Button>
          <Button
            type="primary"
            @click="editCategory"
            :disabled="isAdding"
            :loading="isAdding"
            >{{ isAdding ? "Editing.." : "Edit Category" }}</Button
          >
        </div>
      </Modal>

      <!-- delte tag modal -->
      <!-- <Modal v-model="showDeleteModal" width="360">
        <p slot="header" style="color: #f60; text-align: center">
          <Icon type="ios-information-circle"></Icon>
          <span>Delete confirmation</span>
        </p>
        <div style="text-align: center">
          <p>Are you sure you want to delete this category?</p>
        </div>
        <div slot="footer">
          <Button
            type="primary"
            size="large"
            long
            :loading="isDeleting"
            :disabled="isDeleting"
            @click="deleteCategory()"
            >Delete</Button
          >
        </div>
      </Modal> -->
      <!--/. container-fluid -->
      <deleteModal></deleteModal>
    </section>
    <!-- /.content -->
  </div>
  <!-- tag adding modal -->
</template>

<script>
import { mapGetters } from 'vuex'
import deleteModal from '../components/deleteModal'
export default {
  data() {
    return {
      data: {
        iconImage: "",
        categoryName: "",
      },
      addModal: false,
      editModal: false,
      isAdding: false,
      categories: [],
      editData: {
        iconImage: "",
        categoryName: "",
      },
      index: -1,
      showDeleteModal: false,
      isDeleting: false,
      deleteItem: {},
      deletingIndex: -1,
      token: "",
      isIconImageNew: false,
      isEditingItem:false,
    };
  },

  methods: {
    async addCategory() {
      if (this.data.categoryName.trim() == "")
        return this.error("Category name is required");
      if (this.data.iconImage.trim() == "")
        return this.error("Icon image is required");
      this.data.iconImage = `${this.data.iconImage}`;
      const res = await this.callApi("post", "app/create_category", this.data);
      if (res.status === 201) {
        this.categories.unshift(res.data);
        this.success("Category has been added successfully!");
        this.addModal = false;
        this.data.categoryName = "";
        this.data.iconImage = "";
      } else {
        if (res.status === 422) {
          if (res.data.errors.categoryName) {
            this.error(res.data.errors.categoryName[0]);
          }
          if (res.data.errors.iconImage) {
            this.error(res.data.errors.iconImage[0]);
          }
        } else {
          this.smwr();
        }
      }
    },

    // edit tag
    async editCategory() {
      if (this.editData.categoryName.trim() == "")
        return this.error("Category name is required");
      if (this.editData.iconImage.trim() == "")
        return this.error("Icon image is required");

      const res = await this.callApi("post", "app/edit_category", this.editData);
      if (res.status === 200) {
        this.categories[this.index].categoryName = this.editData.categoryName;
        this.success("Category updated successfully!");
        this.editModal = false;
      } else {
        if (res.status === 422) {
          if (res.data.errors.categoryName) {
            this.error(res.data.errors.categoryName[0]);
          }
          if (res.data.errors.iconImage) {
            this.error(res.data.errors.iconImage[0]);
          }
        } else {
          this.smwr();
        }
      }
    },
    showEditModal(category, index) {
      //   let obj = {
      //     id: tag.id,
      //     tagName: tag.tagName,
      //   };
      this.editData = category
      this.editModal = true
      this.index = index
      this.isEditingItem=true
    },

    showDeletingModal(category, i) {
      const   deleteModalObj = {
            showDeleteModal: true,
            deleteUrl: 'app/delete_category',
            data: category,
            deleteingIndex: i,
            isDeleted: false,

        }
        this.$store.commit('setDeletingModalObj', deleteModalObj)
        // console.log('delete method called')
    //   this.deleteItem = tag;
    //   this.deletingIndex = i;
    //   this.showDeleteModal = true;
    },

    handleSuccess(res, file) {
      res = `/uploads/${res}`
      if (this.isEditingItem) {
        return this.editData.iconImage = res
      }
      this.data.iconImage = res;
    },
    handleError(res, file) {
      this.$Notice.warning({
        title: "The file format is incorrect",
        desc: `${
          file.errors.file.length ? file.errors.file[0] : "Something went wrong"
        }`,
      });
    },
    handleFormatError(file) {
      this.$Notice.warning({
        title: "The file format is incorrect",
        desc:
          "File format of " +
          file.name +
          " is incorrect, pleae select jpg or png",
      });
    },
    handleMaxSize(file) {
      this.$Notice.warning({
        title: "excceding file size limit",
        desc: "File " + file.name + " is too large, no more 2mb",
      });
    },

    async deleteImage(isAdd = true) {
        let image
      if (!isAdd) {
        this.isIconImageNew = true;
        image = this.editData.iconImage;
        this.editData.iconImage = '';
        this.$refs.editDataUploads.clearFiles();
      } else {
        image = this.data.iconImage;
        this.data.iconImage = '';
        this.$refs.uploads.clearFiles();
      }

      const res = await this.callApi("post", "app/delete_image", {
        imageName: image,
      });
      if (res.status != 200) {
        this.data.iconImage = image;
        this.smwr();
      }
    },
     closeEditModal(){
          this.isEditingItem=false
          this.editModal=false
      }
  },

  async created() {
    this.token = window.laravel.csrfToken;
    const res = await this.callApi("get", "app/get_categories");
    if ((res.status = 200)) {
      this.categories = res.data;
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
              this.categories.splice(obj.deletingIndex, 1)
          }
      }

  }
};
</script>
