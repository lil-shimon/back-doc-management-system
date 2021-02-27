<template>
  <div class="content-wrapper is-add_style">
    <div class="main_content p-setting">
      <div class="is-body_content">
        <h1 class="is-body_content__title">項目登録</h1>
        <div class="p-setting__tab">
          <ul>
            <li v-on:click="show_setting_type = 1">
              <a v-if="show_setting_type != 1">商品</a>
              <a v-if="show_setting_type == 1" class="is-active">商品</a>
            </li>
            <li v-on:click="show_setting_type = 2">
              <a v-if="show_setting_type != 2">送料</a>
              <a v-if="show_setting_type == 2" class="is-active">送料</a>
            </li>
            <li v-on:click="show_setting_type = 3">
              <a v-if="show_setting_type != 3">ユーザー</a>
              <a v-if="show_setting_type == 3" class="is-active">ユーザー</a>
            </li>
            <li v-on:click="show_setting_type = 4">
              <a v-if="show_setting_type != 4">会社ロゴ</a>
              <a v-if="show_setting_type == 4" class="is-active">会社ロゴ</a>
            </li>
          </ul>
        </div>
        <producttable v-if="show_setting_type == 1"></producttable>
        <postagetable v-if="show_setting_type == 2"></postagetable>
        <usertable v-if="show_setting_type == 3"></usertable>
        <companylogotable v-if="show_setting_type == 4"></companylogotable>
      </div>
    </div>
  </div>
</template>

<script>
import producttable from "./ProducttableComponent";
import postagetable from "./PostagetableComponent";
import usertable from "./UsertableComponent";
import companylogotable from "./CompanylogotableComponent";

export default {
  components: {
    producttable,
    postagetable,
    usertable,
    companylogotable
  },
  data() {
    return {
      show_setting_type: 1
    };
  }
};
</script>

<style></style>
