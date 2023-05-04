<!doctype html>
<html lang="pt">

<head>
    <base href="/">
    <script src="/dmxAppConnect/dmxAppConnect.js"></script>
    <meta charset="UTF-8">
    <title>Mural de Recados!</title>

    <link rel="stylesheet" href="/assets/css/style.css" />
    <script src="/js/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="/fontawesome4/css/font-awesome.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/bootstrap/4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/dmxAppConnect/dmxBootstrap4TableGenerator/dmxBootstrap4TableGenerator.css" />
    <script src="/dmxAppConnect/dmxBootstrap4PagingGenerator/dmxBootstrap4PagingGenerator.js" defer></script>
    <script src="/dmxAppConnect/dmxBootstrap4Navigation/dmxBootstrap4Navigation.js" defer></script>
    <script src="/dmxAppConnect/dmxDataTraversal/dmxDataTraversal.js" defer></script>
    <script src="/dmxAppConnect/dmxBootstrap4Modal/dmxBootstrap4Modal.js" defer></script>
</head>

<body is="dmx-app" id="index" class="bg">
    <dmx-serverconnect id="conn_listar_posts" url="/dmxConnect/api/posts/index.php" dmx-param:limit="10"></dmx-serverconnect>
    <dmx-serverconnect id="conn_delete" url="/dmxConnect/api/posts/delete.php" noload="true" dmx-on:success="conn_listar_posts.load({})"></dmx-serverconnect>
    <header class="topo">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="style3">Mural de recados</h1>
                </div>
            </div>
        </div>

    </header>
    <main class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col mb-3 pl-0 pr-0">
                    <button id="btn1" class="btn btn-primary" dmx-on:click="data_detail1.select(null);data_detail1.modal1.show()"><i class="fa fa-plus">&nbsp;</i>Nova mensagem</button>
                </div>
            </div>
            <div class="row box-posts">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Mensagem</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody is="dmx-repeat" dmx-generator="bs4table" dmx-bind:repeat="conn_listar_posts.data.query.data" id="tableRepeat1">
                                <tr>
                                    <td dmx-text="title"></td>
                                    <td dmx-text="content"></td>
                                    <td>
                                        <button id="btn2" class="btn btn-info" dmx-on:click="data_detail1.select(id);data_detail1.modal1.show()"><i class="fa fa-pencil"></i></button>
                                        <button id="btn3" class="btn btn-danger" dmx-on:click="conn_delete.load({id: id})"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row box-posts">
                <div class="col">
                    <ul class="pagination justify-content-center mb-0" dmx-populate="conn_listar_posts.data.query" dmx-generator="bs4paging">
                        <li class="page-item" dmx-class:disabled="conn_listar_posts.data.query.page.current == 1" aria-label="First">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="conn_listar_posts.load({offset: conn_listar_posts.data.query.page.offset.first})"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="conn_listar_posts.data.query.page.current == 1" aria-label="Previous">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="conn_listar_posts.load({offset: conn_listar_posts.data.query.page.offset.prev})"><span aria-hidden="true">&lsaquo;</span></a>
                        </li>
                        <li class="page-item" dmx-class:active="title == conn_listar_posts.data.query.page.current" dmx-class:disabled="!active" dmx-repeat="conn_listar_posts.data.query.getServerConnectPagination(2,1,'...')">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="conn_listar_posts.load({offset: (page-1)*conn_listar_posts.data.query.limit})">{{title}}</a>
                        </li>
                        <li class="page-item" dmx-class:disabled="conn_listar_posts.data.query.page.current ==  conn_listar_posts.data.query.page.total" aria-label="Next">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="conn_listar_posts.load({offset: conn_listar_posts.data.query.page.offset.next})"><span aria-hidden="true">&rsaquo;</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="conn_listar_posts.data.query.page.current ==  conn_listar_posts.data.query.page.total" aria-label="Last">
                            <a href="javascript:void(0)" class="page-link" dmx-on:click="conn_listar_posts.load({offset: conn_listar_posts.data.query.page.offset.last})"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <div class="container" is="dmx-data-detail" id="data_detail1" dmx-bind:data="conn_listar_posts.data.query.data" key="id">
        <div class="modal fade" id="modal1" is="dmx-bs4-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Mensagens</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form is="dmx-serverconnect-form" id="serverconnectform1" method="post" action="/dmxConnect/api/posts/insert_update.php" dmx-generator="bootstrap4" dmx-form-type="vertical" dmx-populate="data_detail1.data" dmx-on:success="modal1.hide();conn_listar_posts.load({})">
                            <input type="hidden" name="id" id="inp_id" dmx-bind:value="data_detail1.data.id">
                            <div class="form-group">
                                <label for="inp_title">Título</label>
                                <input type="text" class="form-control" id="inp_title" name="title" dmx-bind:value="data_detail1.data.title" aria-describedby="inp_title_help" placeholder="Insira o título...">
                            </div>
                            <div class="form-group">
                                <label for="inp_content">Mensagem</label>
                                <textarea id="inp_content" name="content" dmx-bind:value="data_detail1.data.content" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-success" dmx-bind:value="data_detail1.data.Save" dmx-bind:disabled="state.executing">Salvar <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/bootstrap/4/js/popper.min.js"></script>
    <script src="/bootstrap/4/js/bootstrap.min.js"></script>
</body>

</html>