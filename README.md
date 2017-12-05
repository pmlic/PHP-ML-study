# PHP-ML 学习

参考: 
 PHP-ML - 机器学习PHP库 http://doc.celerstar.com/website/soft/php-ml/
 
 知乎    http://wow0.cn/2017/11/03/php-ml-apply/?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io
 
翻译php-ml列表目录

```
    Association rule learning 关联规则算法
    
                Apriori–这是十大经典挖掘算法之一
                
    Classification 分类算法
    
        SVC–SVM的分类形式
        
        k-Nearest Neighbors–knn算法，机器学习上，地位等同于于web经典的hello world
        
        Naive Bayes–朴素贝叶斯算法，P(A/B)=P(B/A)*P(A)/P(B),由贝叶斯公式变形的一种算法
        
        Decision Tree (CART)–决策树算法
        
        Ensemble Algorithms–集成算法
        
            Bagging (Bootstrap Aggregating)–自助法
            
            Random Forest–随机森林算法，后现代SVM
            
            AdaBoost–自适应迭代上升算法
            
        Linear–线性分类器
        
            Adaline–学习机
            
            Decision Stump–决策桩
            
            Perceptron–感知器
            
            LogisticRegression–逻辑回归，初学者必备算法
            
    Regression–回归算法
    
        Least Squares–最小平方法
        
        SVR–SVM的回归形式
        
    Clustering–聚类算法
    
        k-Means–经典聚类算法，常问：与knn区别？
        
        DBSCAN–基于密度聚类算法
        
        Fuzzy C-Means–模糊聚类算法，很有意思的算法
        
    Metric–度量方式（校验模型是否收敛较好的方法）
    
        Accuracy–准确率，关联信息，F1得分与召回率和查准率
        
        Confusion Matrix–混淆矩阵
        
        Classification Report–分类报告
        
    Workflow–工作流
    
        Pipeline–管道
        
    Neural Network–神经网络，近几年非常强大算法之一
    
        Multilayer Perceptron Classifier–多层感知器
        
    Cross Validation–交叉验证，必学的train／test／cv
    
        Random Split–随机分割
        
        Stratified Random Split–分层随机分割
        
    Preprocessing–数据预处理（数据清洗）
    
        Normalization–标准化
        
        Imputation missing values–补充缺失值，很好用
        
    Feature Extraction–特征提取
    
        Token Count Vectorizer–文本处理方式之一
        
        Tf-idf Transformer–文本方式处理方式之一，目的上解决减少频繁单词权重，增加冷门有决定因素单词权重
    Dimensionality Reduction–降低维度
    
        PCA (Principal Component Analysis)–降低维度高效方法
        
        Kernel PCA–套核的PCA
        
        LDA (Linear Discriminant Analysis)
        
    Datasets–数据结构
        Array
        
        CSV
        
        Files
        
    Ready to use:–官方准备的测试数据
    
        Iris
            最受欢迎和广泛使用的虹膜测量和类名的数据集。
        Wine
            葡萄酒化学成分数据集
        Glass
            
    Models management–模型惯例方法
    
        Persistency–持久性
        
    Math–数学结构与类型
    
    Distance
    
    Matrix
    
    Set
    
    Statistic
    
    Linear Algebra
    
```

> 参考: https://www.cnblogs.com/en-heng/p/5719101.html 

- KNN 算法
    
    邻近算法，或者说K最近邻(kNN，k-NearestNeighbor)分类算法是数据挖掘分类技术中最简单的方法之一。
    所谓K最近邻，就是k个最近的邻居的意思，说的是每个样本都可以用它最接近的k个邻居来代表。
    kNN算法的核心思想是如果一个样本在特征空间中的k个最相邻的样本中的大多数属于某一个类别，则该样本也属于这个类别，并具有这个类别上样本的特性。该方法在确定分类决策上只依据最邻近的一个或者几个样本的类别来决定待分样本所属的类别。 
    kNN方法在类别决策时，只与极少量的相邻样本有关。由于kNN方法主要靠周围有限的邻近的样本，而不是靠判别类域的方法来确定所属类别的，因此对于类域的交叉或重叠较多的待分样本集来说，kNN方法较其他方法更为适合。
    
 
>  算法计算步骤   
    
    ```
        1. 算距离：给定测试对象，计算它与训练集中的每个对象的距离； 
        
        2. 找邻居：圈定距离最近的k个训练对象，作为测试对象的近邻； 
        
        3. 做分类：根据这k个近邻归属的主要类别，来对测试对象分类。
    ```
> 参考: https://wenku.baidu.com/view/d84cf670a5e9856a561260ce.html

- LeastSquares  最小二乘法

  最小二乘法（又称最小平方法）是一种数学优化技术。它通过最小化误差的平方和寻找数据的最佳函数匹配。利用最小二乘法可以简便地求得未知的数据，并使得这些求得的数据与实际数据之间误差的平方和为最小。最小二乘法还可用于曲线拟合。其他一些优化问题也可通过最小化能量或最大化熵用最小二乘法来表达。 
  
> 参考: https://www.cnblogs.com/softlin/p/5815531.html

> php-ML 二乘法算法 使用如  car_price.php 
> php-ML 回归预测算法 使用如  stock.php 

- SVM 支持向量算法  [SVM](./SVR.md)

> php-ML SVR算法实验 使用如  svr.php 

-  Apriori算法 关联规则 [Apriori](./Apriori.md)

> php-ML Apriori 关联规则算法 使用如 index.php
> php-ML Apriori 关联规则算法 使用如 apriori.php