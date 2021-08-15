<template>
  <div>
      <div v-if="$store.state.user">
     <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="index3.html" class="brand-link">

            <span class="brand-text font-weight-light">LaraveVue</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">

              </div>
              <div class="info">
                <a href="#" class="d-block">Admin</a>
              </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <!-- <li class="nav-item menu-open">
                  <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="./index.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v1</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="./index2.html" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v2</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="./index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v3</p>
                      </a>
                    </li>
                  </ul>
                </li> -->
                <li class="nav-item" v-for="(menuItem,i) in permission" v-if="permission.length && menuItem.read">
                    <router-link :to="menuItem.name" class="nav-link">  <i class="nav-icon fas fa-th"></i>{{menuItem.resourceName}}</router-link>

                </li>
<!--                 <li class="nav-item">-->
<!--                    <router-link to="tags" class="nav-link">  <i class="nav-icon fas fa-th"></i>Tags Manager</router-link>-->

<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <router-link to="category" class="nav-link">  <i class="nav-icon fas fa-th"></i>Category Manager</router-link>-->

<!--                </li>-->
<!--                 <li class="nav-item">-->
<!--                    <router-link to="admin-users" class="nav-link">  <i class="nav-icon fas fa-th"></i>Users Manager</router-link>-->

<!--                </li>-->
<!--                  <li class="nav-item">-->
<!--                      <router-link to="roles" class="nav-link">  <i class="nav-icon fas fa-th"></i>Roles Manager</router-link>-->

<!--                  </li>-->
<!--                  <li class="nav-item">-->
<!--                      <router-link to="assignRoles" class="nav-link">  <i class="nav-icon fas fa-th"></i>Assign Roles</router-link>-->

<!--                  </li>-->
<!--                <li class="nav-item">-->
<!--                    <a href="/logout" class="nav-link">  <i class="nav-icon fas fa-th"></i>Logout</a>-->

<!--                </li>-->

<!--                <li class="nav-item">-->
<!--                  <a href="#" class="nav-link">-->
<!--                    <i class="nav-icon fas fa-book"></i>-->
<!--                    <p>-->
<!--                      Pages-->
<!--                      <i class="fas fa-angle-left right"></i>-->
<!--                    </p>-->
<!--                  </a>-->
<!--                  <ul class="nav nav-treeview">-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/invoice.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>Invoice</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/profile.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>Profile</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/e-commerce.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>E-commerce</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/projects.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>Projects</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/project-add.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>Project Add</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/project-edit.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>Project Edit</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/project-detail.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>Project Detail</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/contacts.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>Contacts</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/faq.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>FAQ</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                      <a href="pages/examples/contact-us.html" class="nav-link">-->
<!--                        <i class="far fa-circle nav-icon"></i>-->
<!--                        <p>Contact us</p>-->
<!--                      </a>-->
<!--                    </li>-->
<!--                  </ul>-->
<!--                </li>-->

                <!-- <li class="nav-header">MISCELLANEOUS</li>
                <li class="nav-item">
                  <a href="iframe.html" class="nav-link">
                    <i class="nav-icon fas fa-ellipsis-h"></i>
                    <p>Tabbed IFrame Plugin</p>
                  </a>
                </li> -->

              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>
      </div>
<router-view></router-view>
  </div>
</template>

<script>
export default {
    props:['user','permission'],
    data(){
        return{
            isLoggedIn:false,
        }
    },
    created() {
        this.$store.commit('setUpdateUser', this.user)
        this.$store.commit('setUserPermission', this.permission)
        // console.log(this.permission)
        // console.log(this.user)
    },
}
</script>
