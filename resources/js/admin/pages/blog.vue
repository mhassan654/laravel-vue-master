<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Blog Post</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create blog</li>
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
              <div class="_input_field">
                <Input type="text" v-model="data.title" placeholder="title" />
              </div>
              <div class="card-body p-0">
                <div class="blog_editor">
                  <!-- <editor
                    ref="editor"
                    autofocus
                    holder-id="codex-editor"
                    save-button-id="save-button"
                    :init-data="initData"
                    @save="onSave"
                    :config="config"
                    :additionRequestData="{ name: 'bra' }"
                  /> -->
                  <Editor
                    ref="editor"
                    autofocus
                    save-button-id="save-button"
                    @save="onSave"
                    :config="config"
                    :init-data="onInitialized"
                  />
                </div>
              </div>
              <div class="_input_field">
                <Input
                  type="textarea"
                  v-model="data.post_excerpt"
                  :autosize="{ minRows: 4, maxRows: 6 }"
                  placeholder="Post excerpt"
                ></Input>
              </div>

              <div class="_input_field">
                <Select
                  filterable
                  multiple
                  placeholder="select category"
                  v-model="data.category_id"
                >
                  <Option
                    v-for="(cat, i) in category"
                    :value="cat.id"
                    :key="i"
                    >{{ cat.categoryName }}</Option
                  >
                </Select>
              </div>

              <div class="_input_field">
                <Select
                  filterable
                  multiple
                  placeholder="select tag"
                  v-model="data.tag_id"
                >
                  <Option
                    v-for="(t, i) in tags"
                    :value="t.id"
                    :key="i"
                    >{{ t.tagName }}</Option
                  >
                </Select>
              </div>

              <div class="_input_field">
                <Input
                  type="textarea"
                  v-model="data.metaDescription"
                  :autosize="{ minRows: 4, maxRows: 6 }"
                  placeholder="meta description"
                ></Input>
              </div>

              <div class="_input_field">
                <Button
                  @click="save"
                  :loading="isCreating"
                  :disabled="isCreating"
                  >{{ isCreating ? "Please wait..." : "Create Blog" }}</Button
                >
              </div>

              <div class="card-footer clearfix">
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Add New Tag</a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
import { Editor } from "vue-editor-js/src/index";
import Header from "@editorjs/header";
import Paragraph from "@editorjs/paragraph";
export default {
  components: {
    Editor,
    Header,
    Paragraph,
  },
  data() {
    return {
      config: {
        tools: {
          header: {
            class: Header,
            config: {
              placeholder: "Enter a header",
              levels: [2, 3, 4],
              defaultLevel: 3,
            },
          },
          paragraph: {
            class: Paragraph,
          },
          list: require("@editorjs/list"),
          quote: require("@editorjs/quote"),
          checklist: require("@editorjs/checklist"),
          code: require("@editorjs/code"),
          image: require("@editorjs/image"),
        },
      },
      onInitialized: null,

      data: {
        title: "",
        post: "",
        post_excerpt: "",
        metaDescription: "",
        category_id: [],
        tag_id: [],
        jsonData:null
      },

      articleHTML: "",
      category: [],
      tags: [],
      isCreating: false,
    }
  },

  methods: {

    async onSave(response) {
      var data = response;
         this.data.jsonData = JSON.stringify(data);
    //    await this.outputHtml(data.blocks);
          // console.log(this.articleHTML);
          console.log(data)

      this.data.post = this.articleHTML;
      this.data.jsonData = JSON.stringify(data);
      this.isCreating = true;
    //   const res = await this.callApi("post", "app/create-blog", this.data);
    //   if (res.status === 201) {
    //     this.success("Blog has been creaated successfully!");
    //   } else {
    //     this.smwr();
    //   }
      //   console.log(this.articleHTML);
      //   console.log(data)
    },

     save(response) {
            //  var data = response;
      this.$refs.editor._data.state.editor.save()
      .then((data) => {
        //   this.data.jsonData = JSON.stringify(data);
         this.outputHtml(data.blocks);

          this.data.post = this.articleHTML;
        console.log( this.data.jsonData = JSON.stringify(data)) ;
          this.isCreating = true;
         const res =  this.callApi("post", "app/create-blog", this.data);

         if (res.status === 200) {
         this.success("Blog has been creaated successfully!");
         this.$router.push('/blogdata')
      } else {
          this.success("Blog has been creaated successfully!");
        //    this.$router.push('/blogdata')
        // this.smwr();
      }
      this.isCreating = false
        //   console.log(this.articleHTML);
      	// Do what you want with the data here

      	// console.log(data)
      })
      .catch(err => { console.log(err) })
    },

    outputHtml(articleObj) {
      articleObj.map(obj => {
        switch (obj.type) {
          case "paragraph":
            this.articleHTML += this.makeParagraph(obj);
            break;
          case "image":
            this.articleHTML += this.makeImage(obj);
            break;
          case "header":
            this.articleHTML += this.makeHeader(obj);
            break;
          case "raw":
            this.articleHTML += `<div class="container">
                    <div class="block-content">
                    <div class="ce-code">
                    <code>${obj.data.html}</code>
                    </div>
                    </div>
                    </div>\n`;
            break;
          case "code":
            this.articleHTML += this.makeCode(obj);
            break;
          case "list":
            this.articleHTML += this.makeList(obj);
            break;
          case "quote":
            this.articleHTML += this.makeQuote(obj);
            break;
          case "warning":
            this.articleHTML += this.makeWarning(obj);
            break;
          case "checklist":
            this.articleHTML += this.makeChecklist(obj);
            break;
          case "embed":
            this.articleHTML += this.makeEmbed(obj);
            break;
          case "delimeter":
            this.articleHTML += this.makeDelimeter(obj);
            break;
          default:
            return "";
        }
      });
    },
  },



   async created() {
      const [cat, tag] = await Promise.all([
          this.callApi("get", "app/get_categories"),
          this.callApi("get", "app/get_tags")
      ])

    if ((cat.status = 200)) {
    this.category = cat.data
    } else {
      this.smwr();
    }
      if ((tag.status = 200)) {
         this.tags = tag.data
      } else {
          this.smwr();
      }
  },
};
</script>

<style>
.blog_editor {
  width: 717px;
  margin-left: 160px;
  padding: 4px 7px;
  font-size: 14px;
  border-radius: 4px;
  border: 1px solid #dcdee2;
  color: #515a6e;
  background-color: #fff;
  background-image: none;
  z-index: -1;
}

.blog_editor:hover {
  border: 1px solid #57a3f3;
}
._input_field {
  margin: 20px 0 0 160px;
  width: 717px;
}
</style>
