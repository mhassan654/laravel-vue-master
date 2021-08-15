<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Blogs</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blogs</li>
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
                  <Button type="primary" @click="$router.push('/blog')"
                    ><Icon type="primary" />Create Blog</Button
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
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Views</th>
                        <th>Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(blog, b) in blogs"
                        :key="b"
                        v-if="blogs.length"
                      >
                        <td>
                          {{ blog.id }}
                        </td>
                        <td>{{ blog.title }}</td>
                        <td>
                          <span
                            type="primary"
                            v-for="(c, i) in blog.cat"
                            v-if="blog.cat.length"
                            :key="i"
                          >
                            <Tag type="border"> {{ c.categoryName }}</Tag>
                          </span>
                        </td>
                        <td>
                          <span
                            v-for="(t, j) in blog.tag"
                            v-if="blog.tag.length"
                            :key="j"
                          >
                            <Tag type="border">{{ t.tagName }}</Tag></span
                          >
                        </td>
                        <td>
                          {{ blog.views }}
                        </td>
                        <td>
                          {{ blog.created_at }}
                        </td>

                        <td>
                          <Button type="info" size="small">View Blog</Button>
                          <Button
                            type="info"
                            size="small"
                            @click="$router.push[`/editblog/${blog.id}`]"
                            v-if="isUpdatingPermitted"
                            >Edit</Button
                          >
                          <Button
                            type="error"
                            size="small"
                            @click="showDeletingModal(blog, i)"
                            :loading="blog.isDeleting"
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

              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

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
        tagName: "",
        categoryName: "",
        title: "",
      },

      blogs: [],
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
    showDeletingModal(blog, i) {
      // console.log(i)
      this.deleteingIndex = i;
      const deleteModalObj = {
        showDeleteModal: true,
        deleteUrl: "app/blog/delete",
        data: { id: blog.id },
        deleteingIndex: i,
        isDeleted: false,
        msg: "Are you sure you want to delete?",
        successMsg: "Blog deleted successfully",
      };
      this.$store.commit("setDeletingModalObj", deleteModalObj);
    },
  },

  async created() {
    const res = await this.callApi("get", "app/blogdata");
    if ((res.status = 200)) {
      this.blogs = res.data;
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
        this.blogs.splice(obj.deletingIndex, 1);
      }
    },
  },
};
</script>
