# dev-scirco-cn

**dev.scirco.cn** — SCIRCO 开发测试 / 资源分发站点。

## 站点内容

| 文件/目录 | 说明 |
| --- | --- |
| `index.html` | 站点首页（文件下载列表） |
| `JiYuTrainer.exe` | 极域电子教室相关工具 |
| `极域反控.zip` | 极域反控工具包 |
| `veyonkill.exe` | Veyon 进程结束工具 |
| `信息课助手.exe` | 信息课助手 |
| `网站锁outter.bat` | 网站锁批处理 |
| `dev.exe` | 开发测试程序 |
| `error.html` / `DNS error.html` / `202.html` / `404.html` | 网站伪装/错误页 |
| `rungame/` | 跑酷小游戏（含 `rank.php` 排行榜） |

## 服务器目录

```
/www/wwwroot/dev.scirco.cn
```

## 部署方式

本地修改并推送：

```bash
git add .
git commit -m "描述"
git push
```

服务器拉取更新：

```bash
cd /www/wwwroot/dev.scirco.cn
git pull origin main
```

> 注：`.user.ini`、`.htaccess`、`.well-known/` 为服务器/面板配置文件，已在 `.gitignore` 中排除，不会进入仓库。
