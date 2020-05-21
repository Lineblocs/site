systemctl stop s3fuse
sudo cp s3fuse.service /etc/systemd/system/s3fuse.service
sudo chmod 644 /etc/systemd/system/s3fuse.service
systemctl daemon-reload
systemctl start s3fuse
