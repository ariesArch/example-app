pipeline {
    agent any 
    stages {
        stage('Verify tooling') {
            steps {
                ssh '''
                    docker info
                    docker version
                '''
            }
        }
        stage('Clear all running docker containers') {
            steps {
                script {
                    try {
                        sh 'docker rm -f $(docker ps -aq)'
                    } catch( Exception e) {
                        echo 'No running container to clear up..'
                    }
                }
            }
        }
    }
}